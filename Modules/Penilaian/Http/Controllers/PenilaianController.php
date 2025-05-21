<?php

namespace Modules\Penilaian\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pengaturan\Entities\Anggota;
use Modules\Penilaian\Entities\RencanaKerja;
use Modules\Penilaian\Entities\HasilKerja;
use Modules\Pengaturan\Entities\Pegawai;
use Modules\Penilaian\Entities\Cascading;

class PenilaianController extends Controller
{

    public function getPegawaiWhoLogin($filterTimKerjaId = null){
        $authUser = Auth::user();
        $username = $authUser->pegawai->username;
        $pegawai = Pegawai::with([
            'timKerjaAnggota' => function ($query) use ($filterTimKerjaId) {
                if ($filterTimKerjaId) {
                    $query->where('tim_kerja_anggota.tim_kerja_id', $filterTimKerjaId);
                }
            },
            'timKerjaAnggota.ketua',
            'rencanaKerja.hasilKerja', 'timKerjaAnggota.unit',
            'timKerjaAnggota.subUnits.unit','timKerjaAnggota.parentUnit.unit',
        ])->where('username', $username)->first();

        return $pegawai;
    }

    public function index(){
        return view('penilaian::index');
    }

    public function realisasi(){
        $authUser = Auth::user();
        $pegawai = $authUser->pegawai;
        $pegawaiUsername = $pegawai->username;
        $pegawaiId = $pegawai->id;

        $pegawai = Pegawai::with([
            'timKerjaAnggota',
            'rencanaKerja.hasilKerja',
            'timKerjaAnggota.unit',
            'timKerjaAnggota.subUnits.unit',
            'timKerjaAnggota.parentUnit.unit',
        ])->where('username', $pegawaiUsername)->first();

        if($pegawai->timKerjaAnggota[0]->parentUnit != null){
            $atasan = $pegawai->timKerjaAnggota[0]->parentUnit->ketua->pegawai;
        }

        $timKerjaId = $pegawai->timKerjaAnggota[0]->id;
        $bawahan = Anggota::with(['timKerja', 'pegawai'])
        ->where(function ($query) use ($timKerjaId) {
            $query->where(function ($q) use ($timKerjaId) {
                    $q->whereHas('timKerja', function ($sub) use ($timKerjaId) {
                        $sub->where('parent_id', $timKerjaId);
                    })->where('peran', 'Ketua');
                })
                ->orWhere(function ($q) use ($timKerjaId) {
                    $q->whereHas('timKerja', function ($sub) use ($timKerjaId) {
                        $sub->where('id', $timKerjaId);
                    })->where('peran', 'Anggota');
                });
        })
        ->whereHas('pegawai', function ($q) use ($pegawaiUsername) {
            $q->where('username', '!=', $pegawaiUsername);
        })
        ->get();

        $rencana = RencanaKerja::with('hasilKerja')->where('pegawai_id', '=', $pegawaiId)->first();
        $indikatorIntervensi = Cascading::with('indikator.hasilKerja.rencanakerja')->where('pegawai_id', $pegawaiId)->get();

        return view('penilaian::realisasi', compact('rencana', 'pegawai', 'indikatorIntervensi'));
    }

    public function ajukanRealisasi(Request $request, $id){
        try {
            $rencana = RencanaKerja::find($id);
            foreach($rencana->hasilKerja as $item){
                if (is_null($item->realisasi) || $item->realisasi === '') {
                    return redirect()->back()->with('failed', 'Semua realisasi harus diisi sebelum diajukan.');
                }
            }
            $rencana->update([
                'status_realisasi' => 'Sudah Diajukan'
            ]);
            return redirect()->back()->with('success', 'Realiasi berhasil diajukan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    public function updateRealisasi(Request $request, $id) {
        try {
            $hasilKerja = HasilKerja::find($id);
            $hasilKerja->update([
                'realisasi' => $request['realisasi']
            ]);
            return redirect()->back()->with('berhasil', 'Realisasi berhasil diperbarui.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    public function batalkanPengajuanRealisasi($id){
        try {
            $rencana = RencanaKerja::find($id);
            $rencana->update([ 'status_realisasi' => 'Belum Diajukan' ]);
            return redirect()->back()->with('success', 'Pengajuan Realiasi berhasil dibatalkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    public function kinerjaOrganisasi() {
        return view('penilaian::kinerjaOrganisasi');
    }
}
