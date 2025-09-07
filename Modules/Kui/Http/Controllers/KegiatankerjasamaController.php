<?php

namespace Modules\Kui\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Kui\Entities\Kegiatankerjasama;
use Modules\Kui\Entities\Jurusan;

class KegiatankerjasamaController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // return view('kui::index');
        $allDatakegiatankerjasama = Kegiatankerjasama::all();
        return view('kui::kegiatankerjasama.view_kegiatankerjasama', compact('allDatakegiatankerjasama'));
    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $jurusan = Jurusan::all();
        return view('kui::kegiatankerjasama.add_kegiatankerjasama', compact('jurusan'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // Validasi input terlebih dahulu
        $validated = $request->validate([
            'id_jurusan' => 'required',
            'nama_kegiatan' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'biaya_kegiatan' => 'required|numeric',
            'upload_dokumen' => 'required|file|mimes:pdf|max:2048',
            'upload_foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Simpan data ke model
        $data = new Kegiatankerjasama();
        $data->id_jurusan = $request->id_jurusan;
        $data->nama_kegiatan = $request->nama_kegiatan;
        $data->tanggal_kegiatan = $request->tanggal_kegiatan;
        $data->biaya_kegiatan = $request->biaya_kegiatan;

        // Simpan file dokumen (PDF)
        if ($request->hasFile('upload_dokumen')) {
            $file = $request->file('upload_dokumen');
            $filename = time() . '_dokumen_' . $file->getClientOriginalName();
            $file->storeAs('public/dokumen_kegiatan', $filename);
            $data->dokumen_kegiatan = $filename;
        }

        // Simpan file foto (image)
        if ($request->hasFile('upload_foto')) {
            $foto = $request->file('upload_foto');
            $fotoName = time() . '_foto_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto_kegiatan', $fotoName);
            $data->foto_kegiatan = $fotoName; // pastikan kolom ini ada di tabel
        }

        $data->save();

        // return redirect()->route('kegiatankerjasama.add_kegiatankerjasama')
        //     ->with('info', 'Tambah Kegiatan Kerjasama Berhasil ditambahkan');
        return redirect('/kui/kegiatankerjasama')
            ->with('success', 'Kegiatan Kerjasama berhasil ditambahkan');
    }


    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        // return view('kui::show');
        $kegiatankerjasama = Kegiatankerjasama::findOrFail($id);
        return view('kui::kegiatankerjasama.show_kegiatankerjasama', compact('kegiatankerjasama'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $allDatakegiatankerjasama = Kegiatankerjasama::findOrFail($id);
        // Ambil nama jurusan dari relasi jika ada, dan pastikan bukan string
        $nama_jurusan = null;
        $jurusanObj = $allDatakegiatankerjasama->jurusan;
        if (is_object($jurusanObj)) {
            $nama_jurusan = $jurusanObj->nama_jurusan ?? $jurusanObj->nama;
        } else {
            $nama_jurusan = '-';
        }
        return view('kui::kegiatankerjasama.edit_kegiatankerjasama', compact('allDatakegiatankerjasama', 'nama_jurusan'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'jurusan' => 'required|string',
            'nama_kegiatan' => 'required|string',
            'tanggal_kegiatan' => 'required|date',
            'biaya_kegiatan' => 'required',
            'dokumen_kegiatan' => 'nullable|file|mimes:pdf|max:2048',
            'foto_kegiatan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $allDatakegiatankerjasama = Kegiatankerjasama::findOrFail($id);

        // Bersihkan format Rupiah jika ada
        $biaya_kegiatan = str_replace(['Rp', '.', ' '], '', $request->biaya_kegiatan);
        $biaya_kegiatan = (int)$biaya_kegiatan;

        // Update data dasar
        $allDatakegiatankerjasama->jurusan = $request->jurusan;
        $allDatakegiatankerjasama->nama_kegiatan = $request->nama_kegiatan;
        $allDatakegiatankerjasama->tanggal_kegiatan = $request->tanggal_kegiatan;
        $allDatakegiatankerjasama->biaya_kegiatan = $biaya_kegiatan;

        // Update dokumen jika ada
        if ($request->hasFile('dokumen_kegiatan')) {
            // Hapus file lama jika ada
            if ($allDatakegiatankerjasama->dokumen_kegiatan) {
                Storage::delete('public/dokumen_kegiatan/' . $allDatakegiatankerjasama->dokumen_kegiatan);
            }

            $file = $request->file('dokumen_kegiatan');
            $filename = time() . '_dokumen.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/dokumen_kegiatan', $filename);
            $allDatakegiatankerjasama->dokumen_kegiatan = $filename;
        }

        // Update foto jika ada
        if ($request->hasFile('foto_kegiatan')) {
            // Hapus file lama jika ada
            if ($allDatakegiatankerjasama->foto_kegiatan) {
                Storage::delete('public/foto_kegiatan/' . $allDatakegiatankerjasama->foto_kegiatan);
            }

            $foto = $request->file('foto_kegiatan');
            $fotoName = time() . '_foto.' . $foto->getClientOriginalExtension();
            $foto->storeAs('public/foto_kegiatan', $fotoName);
            $allDatakegiatankerjasama->foto_kegiatan = $fotoName;
        }

        $allDatakegiatankerjasama->save();

        return redirect('/kui/kegiatankerjasama')
            ->with('success', 'Data kegiatan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        try {
            // Cari data yang akan dihapus
            $data = Kegiatankerjasama::findOrFail($id);

            // Lakukan proses penghapusan
            $data->delete();

            // Redirect dengan pesan sukses
            return redirect()->back()
                ->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi masalah
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }

    public function viewDocument($filename)
    {
        $path = storage_path('app/public/dokumen_kegiatan/' . $filename);

        if (!Storage::exists('public/dokumen_kegiatan/' . $filename)) {
            abort(404);
        }

        return response()->file($path);
    }
}
