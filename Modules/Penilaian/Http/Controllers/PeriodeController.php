<?php

namespace Modules\Penilaian\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Penilaian\Entities\Periode;
use Modules\Penilaian\Entities\PeriodeAktif;

class PeriodeController extends Controller {

    public function periode_aktif(){
        $penilaianController = new PenilaianController();
        $pegawai = $penilaianController->getPegawaiWhoLogin();
        $periodeAktif = PeriodeAktif::with('periode')->where('pegawai_id', $pegawai->id)->first();
        $periodeId = $periodeAktif?->periode_id;

        return $periodeId;
    }

    public function index(){
        $periodes = Periode::all();
        return view('penilaian::periode.index', compact('periodes'));
    }

    public function store(Request $request){
        try {
            Periode::create([
                'start_date' => $request->periode_awal,
                'end_date' => $request->periode_akhir,
                'tahun' => $request->tahun,
                'jenis_periode' => $request->jenis_periode
            ]);

            return redirect()->back()->with('success', 'tambah periode berhasil');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function setPeriode(Request $request){
        $request->validate([
            'periodetahun' => 'required|exists:periodes,id',
        ], [
            'periodetahun.required' => 'Periode tahun belum di-set.',
            'periodetahun.exists' => 'Periode tahun tidak ditemukan dalam data.',
        ]);
        $penilaianController = new PenilaianController();
        $pegawai = $penilaianController->getPegawaiWhoLogin();

        try {
            PeriodeAktif::updateOrCreate(
                ['pegawai_id' => $pegawai->id],
                ['periode_id' => $request->periode_range]
            );
            return redirect()->to(url()->previous());
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
}
