<?php

namespace Modules\Kui\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Kui\Entities\Struktur;

class StrukturorganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // return view('kui::index');
        $allDatastrukturorganisasi = Struktur::all();
        return view('kui::strukturorganisasi.view_struktur', compact('allDatastrukturorganisasi'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('kui::strukturorganisasi.add_struktur');
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
            'judul' => 'required|string',
            'foto_struktur' => 'required|file|mimes:jpeg,jpg,png|max:2048',
        ]);

        $data = new Struktur();
        $data->judul = $request->judul;

        if ($request->hasFile('foto_struktur')) {
            $file = $request->file('foto_struktur');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_struktur', $filename);
            $data->foto_struktur = $filename;
        }

        $data->save();

        return redirect('/kui/strukturorganisasi')->with('success', 'Struktur Organisasi berhasil ditambahkan');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        // return view('kui::show');
        $struktur = Struktur::findOrFail($id);
        return view('kui::strukturorganisasi.show_struktur', compact('struktur'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        // return view('kui::edit');
        $allDatastrukturorganisasi = Struktur::findOrFail($id);
        return view('kui::strukturorganisasi.edit_struktur', compact('allDatastrukturorganisasi'));
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
            'nama_file' => 'sometimes|string',
            'foto_struktur' => 'sometimes|file|mimes:jpeg,jpg,png|max:2048',
        ]);

        $allDatastrukturorganisasi = Struktur::findOrFail($id);

        if ($request->filled('nama_file')) {
            $allDatastrukturorganisasi->nama_file = $request->nama_file;
        }

        if ($request->hasFile('foto_struktur')) {
            if ($allDatastrukturorganisasi->foto_struktur) {
                Storage::delete('public/foto_struktur/' . $allDatastrukturorganisasi->foto_struktur);
            }
            $file = $request->file('foto_struktur');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/foto_struktur', $filename);
            $allDatastrukturorganisasi->foto_struktur = $filename;
        }

        $allDatastrukturorganisasi->save();

        return redirect('/kui/strukturorganisasi')->with('success', 'Struktur Organisasi berhasil diperbarui');
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
            $data = Struktur::findOrFail($id);

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
}
