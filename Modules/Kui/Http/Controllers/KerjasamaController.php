<?php

namespace Modules\Kui\Http\Controllers;

// use Illuminate\Contracts\Support\Renderable;
// use Illuminate\Http\Request;

use App\Exports\KerjasamaExport as ExportsKerjasamaExport;
use Modules\Kui\Entities\Jurusan;
use Modules\Kui\Entities\Kategori;
use Modules\Kui\Entities\Kerjasama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Kui\Http\Requests\TambahKerjasamaRequest;
use Modules\Kui\Http\Requests\UpdateKerjasamaRequest;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KerjasamaExport;
use Illuminate\Routing\Controller;

class KerjasamaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // return view('kui::index');
        $roleToIdJurusan = [
            'jurusan bi'=>4,
            'jurusan tm'=> 1,
            'jurusan per'=> 2,
            'jurusan par'=> 3,
            'jurusan ts'=> 5,
        ];

        $userRole = Auth::user()->role;

        if ($userRole === 'admin') {
            $kerjasama = Kerjasama::with('kategori', 'jurusan')->orderBy('id_kerjasama', 'DESC')->paginate(10);
        } else {
            $idJurusan = $roleToIdJurusan[$userRole] ?? null;
            if ($idJurusan) {
                $kerjasama = Kerjasama::with('kategori', 'jurusan')
                    ->whereHas('jurusan', function ($query) use ($idJurusan) {
                        $query->where('jurusan.id_jurusan', $idJurusan);
                    })
                    ->orderBy('id_kerjasama', 'DESC')
                    ->paginate(10);
            } else {
                $kerjasama = collect();
            }
        }

        $jurusan = Jurusan::all();

        return view('kui::datakerjasama.view_kerjasama', [
            'title' => 'Daftar Kerjasama',
            'jurusan' => $jurusan,
            'kerjasama' => $kerjasama
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // return view('kui::create');
        return view('kui::datakerjasama.create', [
            'jurusan'   => Jurusan::all(),
            'kategori'  => Kategori::all(),
            'title'     => 'Tambah Data Kerjasama'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $validated = $request->validated();
        $fileMou = $request->file('mou');
        
        foreach ($validated['jurusan'] as $value) {
            if (is_numeric($value) != 1) {
                $id = $this->tambahJurusan($value);
                $key = array_search($value, $validated['jurusan']);
                unset($validated['jurusan'][$key]);
                array_push($validated['jurusan'], $id);
            }
        }
        
        if (is_numeric($validated['kategori']) != 1) {
            $validated['kategori'] = $this->tambahKategori($validated['kategori']);
        }
        
        try {
            $nomorMouFile = str_replace('/', '-', $validated['nama_contact_person']);
            $fileMou->storeAs('public/file-mou', $nomorMouFile . "." . $fileMou->getClientOriginalExtension());
            $validated['id_user'] = Auth::user()->id;
            $validated['id_kategori'] = $validated['kategori'];
            
            if (Auth::user()->role == "admin") {
                $validated['status'] = 1;
            }
            
            $validated['file_mou'] = $nomorMouFile . '.' . $fileMou->getClientOriginalExtension();
            $permohonan = Kerjasama::create($validated);
            $permohonan->jurusan()->attach($validated['jurusan']);
            
            return redirect()->route('kui.datakerjasama.view_kerjasama')->with('success', 'Berhasil Menambahkan Data Kerjasama');
        } catch (\Throwable $e) {
            return redirect()->route('kui.datakerjasama.create')->with('error', 'Gagal Menambahkan Data Kerjasama');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        // return view('kui::show');
        $kerjasama = Kerjasama::with(['jurusan', 'kategori'])->findOrFail($id);
        $selectedJurusan = [];
        
        foreach ($kerjasama->jurusan as $key) {
            $selectedJurusan[] = $key->id_jurusan;
        }
        
        return view('kui::datakerjasama.show', [
            'title' => 'Detail Kerjasama',
            'kerjasama' => $kerjasama,
            'jurusan' => Jurusan::all(),
            'kategori' => Kategori::all(),
            'selectedJurusan' => $selectedJurusan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        // return view('kui::edit');
        $kerjasama = Kerjasama::with(['jurusan', 'kategori'])->findOrFail($id);
        $selectedJurusan = [];
        
        foreach ($kerjasama->jurusan as $key) {
            $selectedJurusan[] = $key->id_jurusan;
        }
        
        return view('kui::kerjasama.edit', [
            'title' => 'Detail Kerjasama',
            'kerjasama' => $kerjasama,
            'jurusan' => Jurusan::all(),
            'kategori' => Kategori::all(),
            'selectedJurusan' => $selectedJurusan
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validated();
            
            foreach ($validated['jurusan'] as &$value) {
                if (!is_numeric($value)) {
                    $idJurusan = $this->tambahJurusan($value);
                    $value = $idJurusan;
                }
            }

            if (!is_numeric($validated['kategori'])) {
                $validated['kategori'] = $this->tambahKategori($validated['kategori']);
            }

            $fileMou = $request->file('file_mou');

            if (!empty($fileMou)) {
                $this->prosesFileMou($fileMou, $validated);
            }

            $validated['id_user'] = Auth::user()->id;
            $validated['id_kategori'] = $validated['kategori'];

            $permohonan = Kerjasama::findOrFail($id);
            $permohonan->update($validated);
            $permohonan->jurusan()->sync($validated['jurusan']);

            return redirect()->route('kui.datakerjasama.view_kerjasama')->with('success', 'Berhasil Mengubah Data Kerjasama');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Gagal Mengubah Data Kerjasama');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            $kerjasama = Kerjasama::findOrFail($id);
            $kerjasama->delete();
            return redirect()->route('kui.datakerjasama.view_kerjasama')->with('success', 'Berhasil Menghapus Data Kerjasama');
        } catch (\Throwable $e) {
            return redirect()->route('kui.datakerjasama.view_kerjasama')->with('error', 'Gagal Menghapus Data Kerjasama');
        }
    }

    public function download($mou)
    {if (Storage::exists('public/file-mou/' . $mou)) {
            return Storage::download('public/file-mou/' . $mou);
        } else {
            return redirect()->route('kui.datakerjasama.view_kerjasama')->with('error', 'Gagal Download File Mou, File Tidak Ada');
        }
    }
    
    public function cari(Request $request){
        $cari = $request->cari;
        $expired = $request->expired;
        $sort = $request->sort;
        $jurusan = $request->jurusan;
        $kerjasama = Kerjasama::query();
        $jurusan = Jurusan::all();

        $kerjasama->when($cari != null, function ($q) use ($cari) {
            return $q->where('nomor_mou', 'like', "%" . $cari . "%")
                ->orWhere('nama_instansi', 'like', "%" . $cari . "%");
        });

        $kerjasama->when($expired == 'berakhir', function ($q) {
            return $q->where('tgl_berakhir', '<=', Carbon::now());
        });

        $kerjasama->when($expired == 'akan_berakhir', function ($q) {
            return $q->whereBetween('tgl_berakhir', [Carbon::now(), Carbon::now()->addMonth(3)]);
        });

        $kerjasama->when($jurusan != null, function ($q) use ($jurusan) {
            return $q->whereHas('jurusan', function ($q) use ($jurusan) {
                $q->where('jurusan.id_jurusan', $jurusan);
            });
        });

        if ($sort == 'name') {
            $kerjasama->orderBy('nama_instansi');
        } elseif ($sort == 'tanggal_mulai') {
            $kerjasama->orderBy('tgl_mulai');
        } elseif ($sort == 'tanggal_berakhir') {
            $kerjasama->orderBy('tgl_berakhir');
        }

        return view('kui::datakerjasama.view_kerjasama', [
            'title' => 'Data Kerjasama',
            'jurusan' => $jurusan,
            'kerjasama' => $kerjasama->orderBy('id_kerjasama', 'DESC')->paginate(10)
        ]);
    }

    public function export()
    {
        return Excel::download(new KerjasamaExport, 'kerjasamas.xlsx');
    }

    private function tambahJurusan($namaJurusan)
    {
        $jurusan = Jurusan::create(['nama_jurusan' => $namaJurusan]);
        return $jurusan->id_jurusan;
    }

    private function tambahKategori($namaKategori)
    {
        $kategori = Kategori::create(['nama_kategori' => $namaKategori]);
        return $kategori->id_kategori;
    }

    private function prosesFileMou($fileMou, &$validated)
    {
        $validated['nama_contact_person_old'] = str_replace(['/', '.'], '-', $validated['nama_contact_person_old']);
        $nomorMouFile = str_replace(['/', '.'], '-', $validated['nama_contact_person']);

        $oldFilePath = 'public/file-mou/' . $validated['nama_contact_person_old'];
        if (Storage::exists($oldFilePath . '.pdf')) {
            Storage::delete($oldFilePath . '.pdf');
        } elseif (Storage::exists($oldFilePath . '.docx')) {
            Storage::delete($oldFilePath . '.docx');
        }

        $validated['file_mou'] = $nomorMouFile . '.' . $fileMou->getClientOriginalExtension();
        $fileMou->storeAs('public/file-mou/', $validated['file_mou']);
    }
}