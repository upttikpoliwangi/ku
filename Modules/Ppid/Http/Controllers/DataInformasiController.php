<?php

namespace Modules\Ppid\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ppid\Entities\DataInformasi;
use Modules\Ppid\Entities\JenisInformasi;

class DataInformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datainformasi = DataInformasi::with('jenisInformasi')->get();
        return view('ppid::datainformasi.index', compact('datainformasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisInformasi = JenisInformasi::all();
        return view('ppid::datainformasi.create', compact('jenisInformasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_informasi' => 'required|string|max:255',
            'jenis_informasi_id' => 'required|exists:jenis_informasis,id',
            'link' => 'required|url',
        ], [
            'nama_informasi.required' => 'Nama informasi wajib diisi.',
            'jenis_informasi_id.required' => 'Jenis informasi wajib dipilih.',
            'link.required' => 'Link wajib diisi.',
            'link.url' => 'Link harus berupa URL yang valid.',
        ]);

        DataInformasi::create([
            'nama_informasi' => $request->nama_informasi,
            'jenis_informasi_id' => $request->jenis_informasi_id,
            'link' => $request->link,
        ]);

        return redirect()->route('datainformasi.index')->with('success', 'Data Informasi berhasil ditambahkan.');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data_informasi = DataInformasi::findOrFail($id);
        $jenisInformasi = JenisInformasi::all();
        return view('ppid::datainformasi.edit', compact('data_informasi', 'jenisInformasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data_informasi = DataInformasi::findOrFail($id);

        $request->validate([
            'nama_informasi' => 'required|string|max:255',
            'jenis_informasi_id' => 'required|exists:jenis_informasis,id',
            'link' => 'required|url',
        ]);

        $data_informasi->update([
            'nama_informasi' => $request->nama_informasi,
            'jenis_informasi_id' => $request->jenis_informasi_id,
            'link' => $request->link,
        ]);

        return redirect()->route('datainformasi.index')
            ->with('success', 'Data Informasi berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data_informasi = DataInformasi::findOrFail($id);
        $data_informasi->delete();

        return redirect()->route('datainformasi.index')
            ->with('success', 'Data Informasi berhasil dihapus.');
    }
}