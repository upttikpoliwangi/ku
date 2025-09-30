<?php

namespace Modules\Ppid\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Ppid\Entities\KelolaProfil;

class KelolaProfilController extends Controller
{
    // Tampilkan form kelola profil (edit/tambah)
    public function index()
    {
        $kelola_profil = KelolaProfil::first();
        return view('ppid::kelolaprofil.form', compact('kelola_profil'));
    }

    // Tampilkan form tambah profil
    public function create()
    {
        return view('ppid::kelolaprofil.form');
    }

    // Simpan data profil baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_direktur' => 'required|string|max:255',
            'sambutan' => 'required|string',
            'media' => 'nullable|url',
            'ppid' => 'nullable|string',
            'foto_organisasi' => 'nullable|url',
            'tugas_fungsi' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ]);
        // if ($request->hasFile('foto_organisasi')) {
        //     $data['foto_organisasi'] = $request->file('foto_organisasi')->store('profil', 'public');
        // }
        KelolaProfil::create($data);
        return redirect()->route('kelolaprofil.index')->with('success', 'Profil berhasil disimpan.');
    }

    // Tampilkan form edit profil
    public function edit($id)
    {
        $kelola_profil = KelolaProfil::findOrFail(1);
        return view('ppid::kelolaprofil.form', compact('kelola_profil'));
    }

    // Update data profil
    public function update(Request $request, $id)
    {
        $kelola_profil = KelolaProfil::findOrFail($id);
        $data = $request->validate([
            'nama_direktur' => 'required|string|max:255',
            'sambutan' => 'required|string',
            'media' => 'nullable|url',
            'ppid' => 'nullable|string',
            'foto_organisasi' => 'nullable|url',
            'tugas_fungsi' => 'nullable|string',
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
        ]);
        // if ($request->hasFile('foto_organisasi')) {
        //     $data['foto_organisasi'] = $request->file('foto_organisasi')->store('profil', 'public');
        // }

        // if ($request->hasFile('media')) {
        //     $data['media'] = $request->file('media')->store('profil', 'public');
        // }

        $kelola_profil->update($data);
        return redirect()->route('kelolaprofil.index')->with('success', 'Profil berhasil diupdate.');
    }

    // Hapus data profil
    public function destroy($id)
    {
        $kelola_profil = KelolaProfil::findOrFail($id);
        $kelola_profil->delete();
        return redirect()->route('kelolaprofil.index')->with('success', 'Profil berhasil dihapus.');
    }
}

