<?php

namespace Modules\Kui\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\Kui\Entities\Panduan;

class PanduanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // return view('kui::index');
        $allDatapanduan = Panduan::all();
        return view('kui::panduan.view_panduan', compact('allDatapanduan'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('kui::panduan.add_panduan');
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
        'nama_file' => 'required|string',
        'file_panduan' => 'required|file|mimes:pdf|max:2048',
    ]);

       // Simpan data ke model
        $data = new Panduan();
        $data->nama_file = $request->nama_file;

        // Simpan file dokumen (PDF)
        if ($request->hasFile('file_panduan')) {
            $file = $request->file('file_panduan');
            $filename = time() . '_dokumen_' . $file->getClientOriginalName();
            $file->storeAs('public/file_panduan', $filename);
            $data->file_panduan = $filename;
        }


        $data->save();

        return redirect('/kui/panduan')
            ->with('success', 'Panduan berhasil ditambahkan');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $panduan = Panduan::findOrFail($id);
        return view('kui::panduan.show_panduan', compact('panduan'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        // return view('kui::edit');
        $allDatapanduan = Panduan::findOrFail($id);
        return view('kui::panduan.edit_panduan', compact('allDatapanduan'));
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
        'nama_file' => 'sometimes|string', // 'sometimes' artinya validasi hanya jika field ada
        'file_panduan' => 'sometimes|file|mimes:pdf|max:2048',
    ]);

    $allDatapanduan = Panduan::findOrFail($id);
    
    // Update nama file jika ada dalam request
    if ($request->has('nama_file')) {
        $allDatapanduan->nama_file = $request->nama_file;
    }

    // Update dokumen jika ada file baru diupload
    if ($request->hasFile('file_panduan')) {
        // Hapus file lama jika ada
        if ($allDatapanduan->file_panduan) {
            Storage::delete('public/file_panduan/'.$allDatapanduan->file_panduan);
        }
        
        $file = $request->file('file_panduan');
        $filename = time().'_dokumen.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('public/file_panduan', $filename);
        $allDatapanduan->file_panduan = $filename;
    }

    $allDatapanduan->save();

    return redirect('/kui/panduan')
            ->with('success', 'Data panduan berhasil diperbarui');
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
            $data = Panduan::findOrFail($id);
            
            // Lakukan proses penghapusan
            $data->delete();
            
            // Redirect dengan pesan sukses
            return redirect()->back()
                ->with('success', 'Data berhasil dihapus!');
                
        } catch (\Exception $e) {
            // Redirect dengan pesan error jika terjadi masalah
            return redirect()->back()
                ->with('error', 'Gagal menghapus data: '.$e->getMessage());
        }
        // return redirect()->route('panduan.view')->with('info','Delete Mahasiswa berhasil');
    }
    public function viewDocument($filename)
    {
        $path = storage_path('app/public/file_panduan/' . $filename);

        if (!Storage::exists('public/file_panduan/' . $filename)) {
            abort(404);
        }

        return response()->file($path);
    }
}
