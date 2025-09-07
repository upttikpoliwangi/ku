<?php

namespace Modules\Kui\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Kui\Entities\Jurusan;
use Modules\Kui\Entities\Post;
use Modules\Kui\Entities\Kategori;
use Modules\Kui\Entities\Kerjasama;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

use DOMDocument;

class DataaktivitasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // return view('kui::index');
        $query = Post::query();
        if (request('search')) {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('kegiatan', 'like', "%$search%")
                ->orWhere('nomor_mou', 'like', "%$search%")
                ->orWhere('tanggal', 'like', "%$search%");
            });
        }
        $posts = $query->paginate(10);
        return view('kui::dataaktivitas.view_aktivitas', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // return view('kui::create');
        $kategori = Kategori::all();
        $kerjasama = Kerjasama::select('nomor_mou')->get();
        return view('kui::dataaktivitas.add_aktivitas', compact('kategori', 'kerjasama'));
    
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required',
            'nomor_mou' => 'required',
            'kegiatan' => 'required',
            'tanggal' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required',
        ]);

        try {
            $foto = $request->file('foto');
            $nama_file = time() . "_" . $foto->getClientOriginalName();
            $tujuan_upload = 'data_aktivitas';
            $foto->move($tujuan_upload, $nama_file);

            $deskripsi = $request->deskripsi;
            $dom = new DOMDocument();
            $dom->loadHTML($deskripsi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $key => $img) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $image_name = "/upload/" . time() . $key . '.png, .jpeg, .jpg';
                file_put_contents(public_path() . $image_name, $data);

                $img->removeAttribute('src');
                $img->setAttribute('src', $image_name);
            }
            $deskripsi = $dom->saveHTML();

            Post::create([
                'id_kategori' => $request->id_kategori,
                'nomor_mou' => $request->nomor_mou,
                'kegiatan' => $request->kegiatan,
                'tanggal' => $request->tanggal,
                'foto' => $nama_file,
                'deskripsi' => $deskripsi
            ]);

            return redirect()->route('kui/dataaktivitas')->with('success', 'Aktivitas berhasil disimpan.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan aktivitas: ' . $e->getMessage());
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
        $post = Post::find($id);
        return view('kui.aktivitas.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        // return view('kui::edit');
        $post = Post::find($id);
        $kategori = Kategori::all();
        $kerjasama = Kerjasama::select('nomor_mou')->get();
        return view('kui.edit_aktivitas', compact('post', 'kategori', 'kerjasama'));
    
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kategori' => 'required',
            'kegiatan' => 'required',
            'nomor_mou' => 'required',
            'tanggal' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi' => 'required',
        ]);

        $post = Post::find($id);

        if (!$post) {
            return back()->with('error', 'Post not found.');
        }

        try {
            if ($request->hasFile('foto')) {
                if (file_exists(public_path('data_aktivitas/' . $post->foto))) {
                    unlink(public_path('data_aktivitas/' . $post->foto));
                }

                $uploadedFile = $request->file('foto');
                $nama_file = time() . "_" . $uploadedFile->getClientOriginalName();
                $tujuan_upload = 'data_aktivitas';
                $uploadedFile->move($tujuan_upload, $nama_file);
            } else {
                $nama_file = $post->foto;
            }

            $deskripsi = $request->deskripsi;
            $dom = new DOMDocument();
            $dom->loadHTML($deskripsi, 9);
            $images = $dom->getElementsByTagName('img');
            foreach ($images as $key => $img) {
                if (strpos($img->getAttribute('src'), 'data:image/') === 0) {
                    $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                    $image_name = "/upload/" . time() . $key . '.png, .jpeg, .jpg';
                    file_put_contents(public_path() . $image_name, $data);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                }
            }
            $deskripsi = $dom->saveHTML();

            $post->update([
                'id_kategori' => $request->id_kategori,
                'kegiatan' => $request->kegiatan,
                'nomor_mou' => $request->nomor_mou,
                'tanggal' => $request->tanggal,
                'foto' => $nama_file,
                'deskripsi' => $deskripsi
            ]);

            return redirect()->route('kui/dataaktivitas')->with('success', 'Aktivitas berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui aktivitas: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // Mengabaikan kesalahan parsing HTML
        libxml_use_internal_errors(true);

        $dom = new DOMDocument();
        $dom->loadHTML(mb_convert_encoding($post->deskripsi, 'HTML-ENTITIES', 'UTF-8'));

        // Mengembalikan penanganan kesalahan ke pengaturan awal
        libxml_clear_errors();
        libxml_use_internal_errors(false);

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $key => $img) {
            $src = $img->getAttribute('src');
            $path = Str::of($src)->after('/');
            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $post->delete();
        return redirect()->back();
    }

    public function show_dataaktivitas($id)
    {
        $kerjasama = Kerjasama::with(['jurusan', 'kategori'])->where('nomor_mou', $id)->first();
        $selectedJurusan = [];
        foreach ($kerjasama->jurusan as $key) {
            $selectedJurusan[] = $key->id_jurusan;
        }

        return view('kui.dataaktivitas.show_dataaktivitas', [
            'title' => 'Detail Aktivitas',
            'kerjasama' => $kerjasama,
            'jurusan' => Jurusan::all(),
            'selectedJurusan' => $selectedJurusan
        ]);
    }
}
