<?php

namespace Modules\Kui\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Kui\Entities\File_mou;

class DatamouController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // return view('kui::index');
        $file = File_mou::paginate(10);
        return view('kui::datamou.view_mou', [
            'title' => 'Daftar File MOU',
            'file' => $file
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        // return view('kui::create');
        return view('kui::datamou.add_mou', [
            'title'     => 'Tambah Data File'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama_file' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:2048',
        ], [
            'nama_file.required' => 'Nama file wajib diisi',
            'file.required' => 'File MOU wajib diupload',
            'file.mimes' => 'File harus berformat PDF',
            'file.max' => 'Ukuran file maksimal 2MB',
        ]);


        try {
            // Pastikan file ada
            if (!$request->hasFile('file')) {
                throw new \Exception('File tidak ditemukan');
            }

            $file = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Simpan file ke folder public/data_file (sesuai dengan update method)
            $file->move(public_path('data_file'), $filename);

            // Simpan data ke database dengan cara yang lebih eksplisit
            $newMou = new File_mou();
            $newMou->nama_file = $request->nama_file;
            $newMou->file = $filename; // Pastikan ini diisi
            $newMou->save();

            return redirect('/kui/datamou')
                ->with('success', 'Data MOU berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('kui::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        // return view('kui::edit');
        $file = File_mou::find($id);
        return view('kui::datamou.edit_mou', [
            'title'     => 'Edit Data File',
            'file'     => $file
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

        $file = File_mou::findOrFail($id);

        $rules = [
            'nama_file' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ];

        $messages = [
            'nama_file.required' => 'Nama file wajib diisi',
            'file.mimes' => 'File harus berformat PDF',
            'file.max' => 'Ukuran file maksimal 2MB',
        ];

        $request->validate($rules, $messages);

        try {
            // Update nama file
            $file->nama_file = $request->nama_file;

            if ($request->hasFile('file')) {
                // Hapus file lama jika ada
                if ($file->file && file_exists(public_path('data_file/' . $file->file))) {
                    unlink(public_path('data_file/' . $file->file));
                }

                // Upload file baru
                $uploadedFile = $request->file('file');
                $filename = time() . '_' . $uploadedFile->getClientOriginalName();
                $uploadedFile->move(public_path('data_file'), $filename);
                $file->file = $filename;
            }

            $file->save();

            return redirect('/kui/datamou')
                ->with('success', 'Data MOU berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $file = File_mou::find($id);
        $file->delete();
        return redirect()->back();
    }


    public function download($id)
    {
        $file = File_mou::findOrFail($id);
    $filePath = public_path('data_file/' . $file->file);
    
    if (!file_exists($filePath)) {
        return redirect()->back()->with('error', 'File tidak ditemukan di server');
    }
    
    return response()->download($filePath, $file->nama_file . '.pdf');
    }

    public function view($id)
{
    $file = File_mou::findOrFail($id);
    $filePath = public_path('data_file/' . $file->file);
    
    if (!file_exists($filePath)) {
        return redirect()->back()->with('error', 'File tidak ditemukan di server');
    }
    
    return response()->file($filePath);
}

}