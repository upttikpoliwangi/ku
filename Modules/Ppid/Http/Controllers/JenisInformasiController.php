<?php

namespace Modules\Ppid\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ppid\Entities\JenisInformasi;

class JenisInformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $jenisinformasi = JenisInformasi::all();
        return view('ppid::jenisinformasi.index', compact('jenisinformasi'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ppid::jenisinformasi.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'jenis_informasi' => 'required|string|max:255',
        ]);
        JenisInformasi::create($request->only(['jenis_informasi']));
        return redirect()->route('jenisinformasi.index')->with('success', 'Jenis Informasi berhasil ditambahkan.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $jenisinformasi = JenisInformasi::findOrFail($id);
        return view('ppid::jenisinformasi.show', compact('jenisinformasi'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $jenis_informasi = JenisInformasi::findOrFail($id);
        return view('ppid::jenisinformasi.edit', compact('jenis_informasi'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $jenisinformasi = JenisInformasi::findOrFail($id);
        $data = $request->validate([
            'jenis_informasi' => 'required|string|max:255',
        ]);
        $jenisinformasi->update($data);
        return redirect()->route('jenisinformasi.index')->with('success', 'Jenis Informasi berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $jenisinformasi = JenisInformasi::findOrFail($id);
        $jenisinformasi->delete();
        return redirect()->route('jenisinformasi.index')->with('success', 'Jenis Informasi berhasil dihapus.');
    }
}
