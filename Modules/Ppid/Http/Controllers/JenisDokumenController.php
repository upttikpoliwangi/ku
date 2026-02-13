<?php

namespace Modules\Ppid\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ppid\Entities\JenisDokumen;

class JenisDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $jenisdokumens = JenisDokumen::all();
        return view('ppid::jenisdokumen.index', compact('jenisdokumens'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('ppid::jenisdokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_dokumen' => 'required|string|max:255',
        ]);
        JenisDokumen::create($request->only(['jenis_dokumen']));
        return redirect()->route('jenisdokumen.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $jenisdokumen = JenisDokumen::findOrFail($id);
        return view('ppid::jenisdokumen.show', compact('jenisdokumen'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $jenisdokumen = JenisDokumen::findOrFail($id);
        return view('ppid::jenisdokumen.edit', compact('jenisdokumen'));
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
            'jenis_dokumen' => 'required|string|max:255',
        ]);
        $jenisdokumen = JenisDokumen::findOrFail($id);
        $jenisdokumen->update($request->only(['jenis_dokumen']));
        return redirect()->route('jenisdokumen.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $jenisdokumen = JenisDokumen::findOrFail($id);
        $jenisdokumen->delete();
        return redirect()->route('jenisdokumen.index')->with('success', 'Data berhasil dihapus.');
    }
}
