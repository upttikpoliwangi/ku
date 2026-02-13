<?php

namespace Modules\Ppid\Http\Controllers;

use App\Models\Core\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Ppid\Entities\Permohonaninformasi;
use Modules\Ppid\Entities\JenisPermohonan;
use Illuminate\Support\Facades\Storage;
use Modules\Ppid\Entities\riwayatpermohonan;

class PermohonaninformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $query = Permohonaninformasi::with('jenisPermohonan');
        if (Auth::user()->role_aktif == 'masyarakat') {
        $query->where('email', Auth::user()->email);
        }

        // Filter berdasarkan nama_pemohon
        if ($request->filled('nama_pemohon')) {
            $query->where('nama_pemohon', 'like', '%' . $request->nama_pemohon . '%');
        }

        // Filter berdasarkan tanggal permohonan (created_at)
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }

        $permohonaninformasi = $query->latest()->paginate(10); // lebih rapi pakai paginate

        return view('ppid::pemohon.index', compact('permohonaninformasi'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $jenis_permohonan = JenisPermohonan::all();
        return view('ppid::pemohon.add', compact('jenis_permohonan'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

         $request->validate([
            'nama_pemohon' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'alamat_pemohon' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
            'email' => 'required|email',
            'informasi_yang_dibutuhkan' => 'required|string',
            'alasan_permohonan' => 'required|string',
            'jenis_permohonan_id' => 'required|exists:jenis_permohonans,id',
            'file' => 'nullable|file|mimes:pdf,xls,xlsx|max:2048', // Optional file validation
            'catatan' => 'nullable|string|max:500',
        ], [
            'nama_pemohon.required' => 'Nama pemohon wajib diisi.',
            'nik.required' => 'NIK wajib diisi.',
            'alamat_pemohon.required' => 'Alamat pemohon wajib diisi.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'informasi_yang_dibutuhkan.required' => 'Informasi yang dibutuhkan wajib diisi.',
            'alasan_permohonan.required' => 'Alasan permohonan wajib diisi.',
            'jenis_permohonan_id.required' => 'Jenis permohonan wajib dipilih.',
            'file.mimes' => 'Format file harus pdf, xls, xlsx.',
            'file.max' => 'Ukuran file maksimal adalah 2MB.',
            'catatan.max' => 'Catatan maksimal 500 karakter.',
        ]);
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('permohonan_files', 'public');
            $request->merge(['file' => $filePath]);
        }

        Permohonaninformasi::create([
            'nama_pemohon' => $request->nama_pemohon,
            'nik' => $request->nik,
            'alamat_pemohon' => $request->alamat_pemohon,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'informasi_yang_dibutuhkan' => $request->informasi_yang_dibutuhkan,
            'alasan_permohonan' => $request->alasan_permohonan,
            'jenis_permohonan_id' => $request->jenis_permohonan_id,
            'status' => 'diproses',
        ]);

        return redirect()->route('permohonaninformasi.index')->with('success', 'Permohonan informasi berhasil dibuat.');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $permohonaninformasi = Permohonaninformasi::with('jenisPermohonan')->findOrFail($id);
        return view('ppid::pemohon.show', compact('permohonaninformasi'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $permohonaninformasi = Permohonaninformasi::findOrFail($id);
        $jenis_permohonan = JenisPermohonan::all();

        return view('ppid::pemohon.edit', compact('permohonaninformasi', 'jenis_permohonan'));
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
            'nama_pemohon' => 'required|string|max:255',
            'nik' => 'required|string|max:20',
            'alamat_pemohon' => 'required|string',
            'nomor_telepon' => 'required|string|max:15',
            'email' => 'required|email',
            'informasi_yang_dibutuhkan' => 'required|string',
            'alasan_permohonan' => 'required|string',
            'jenis_permohonan_id' => 'required|exists:jenis_permohonans,id',
            'status' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,xls, xlsx|max:2048', // Optional file validation
            'catatan' => 'nullable|string|max:500',
        ]);
        $permohonan = Permohonaninformasi::findOrFail($id);
        $data = $request->except('file');
        if ($request->hasfile('file')) {
            if ($request->file && Storage::disk('public')->exists($permohonan->file)) {
                Storage::disk('public')->delete($permohonan->file);
            }          
            $data['file'] = $request->file('file')->store('permohonan_files', 'public');
        }
        $permohonan->update($data);

        if (in_array($request->status, ['ditolak', 'disetujui'])) {
        // Find the user (pemohon) based on NIK or email
        $user = User::where('email', $request->email)
            ->first();

        if ($user) {
            riwayatpermohonan::create([
                'user_id' => $user->id, // ID of the pemohon
                'permohonan_id' => $permohonan->id,
                'nama_pemohon' => $permohonan->nama_pemohon,
                'jenis_permohonan_id' => $permohonan->jenis_permohonan_id,
                'informasi_dibutuhkan' => $permohonan->informasi_yang_dibutuhkan,
                'status' => $permohonan->status,
                'tanggal_permohonan' => now(), // or $permohonan->created_at
            ]);
            }
        }

        return redirect()->route('permohonaninformasi.index')->with('success', 'Permohonan informasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $permohonan = Permohonaninformasi::findOrFail($id);
        $permohonan->delete();

        return redirect()->route('pemohon.index')->with('success', 'Permohonan informasi berhasil dihapus.');
    }
}
