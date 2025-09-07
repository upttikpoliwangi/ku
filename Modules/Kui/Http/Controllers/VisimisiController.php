<?php

namespace Modules\Kui\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Modules\Kui\Entities\VisiMisi;

class VisimisiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = VisiMisi::all();
        return view('kui::admin.visimisi_view', compact('data'));
        // $allDatavisimisi = Visimisi::all();
        // return view('kui::visimisi.view_visimisi', compact('allDatavisimisi'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('kui::admin.visimisi_create');
        // return view ('kui::visimisi.add_visimisi');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'namahalaman' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'struktur_organisasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('struktur_organisasi')) {
            $path = $request->file('struktur_organisasi')->store('struktur', 'public');
        }

        VisiMisi::create([
            'namahalaman' => $request->namahalaman,
            'slug' => Str::slug($request->namahalaman),
            'visi' => $request->visi,
            'misi' => $request->misi,
            'struktur_organisasi' => $path,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan!');
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
        $visimisi = VisiMisi::findOrFail($id);
        return view('kui::admin.edit_visimisi', compact('visimisi'));
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
            'namahalaman' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'struktur_organisasi' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $visimisi = VisiMisi::findOrFail($id);

        $path = $visimisi->struktur_organisasi;
        if ($request->hasFile('struktur_organisasi')) {
            $path = $request->file('struktur_organisasi')->store('struktur', 'public');
        }

        $visimisi->update([
            'namahalaman' => $request->namahalaman,
            'slug' => Str::slug($request->namahalaman),
            'visi' => $request->visi,
            'misi' => $request->misi,
            'struktur_organisasi' => $path,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function showBySlug($slug)
    {
        $data = VisiMisi::where('slug', $slug)->firstOrFail();

        if ($slug === 'struktur-organisasi') {
            return view('kui::landing.struktur', compact('data'));
        }

        return view('kui::landing.visimisi', compact('data'));
    }
}