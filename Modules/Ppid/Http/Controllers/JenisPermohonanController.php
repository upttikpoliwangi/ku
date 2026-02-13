<?php

namespace Modules\Ppid\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ppid\Entities\JenisPermohonan;

class JenisPermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $jenispermohonans = JenisPermohonan::all();
        return view('ppid::jenispermohonan.index', compact('jenispermohonans'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ppid::jenispermohonan.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_permohonan' => 'required|string|max:255',
        ]);
        JenisPermohonan::create($request->only(['jenis_permohonan']));
        return redirect()->route('jenispermohonan.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $jenispermohonan = JenisPermohonan::findOrFail($id);
        return view('ppid::jenispermohonan.show', compact('jenispermohonan'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $jenispermohonan = JenisPermohonan::findOrFail($id);
        return view('ppid::jenispermohonan.edit', compact('jenispermohonan'));
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
            'jenis_permohonan' => 'required|string|max:255',
        ]);
        $jenispermohonan = JenisPermohonan::findOrFail($id);
        $jenispermohonan->update($request->only(['jenis_permohonan']));
        return redirect()->route('jenispermohonan.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $jenispermohonan = JenisPermohonan::findOrFail($id);
        $jenispermohonan->delete();
        return redirect()->route('jenispermohonan.index')->with('success', 'Data berhasil dihapus.');
    }
}
