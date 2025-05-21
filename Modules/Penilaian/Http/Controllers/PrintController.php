<?php

namespace Modules\Penilaian\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Pengaturan\Entities\Pegawai;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;

class PrintController extends Controller {

    public function cetakEvaluasi(Request $request){
        $authUser = Auth::user();
        $authPegawai = $authUser->pegawai;
        $pegawaiUsername = $authPegawai->username;
        $pegawaiId = $authPegawai->id;

        $pegawai = Pegawai::with([
            'pejabat.jabatan',
            'timKerjaAnggota',
            'rencanaKerja.hasilKerja',
            'timKerjaAnggota.unit',
            'timKerjaAnggota.subUnits.unit',
            'timKerjaAnggota.parentUnit.unit',
        ])->where('username', $pegawaiUsername)->first();

        $data = [
            'title' => 'Laporan Kinerja',
            'pegawai' => $pegawai,
            'print_date' => $request->print_date,
            'margin_top'    => $request->margin_top,
            'margin_bottom' => $request->margin_bottom,
            'margin_left'   => $request->margin_left,
            'margin_right'  => $request->margin_right,
        ];

        $pdf = Pdf::loadView('penilaian::cetak-evaluasi-page', $data);
        $pdf->setPaper('a4', $request->position);
        return $pdf->download('laporan.pdf');
    }

    public function cetakDokEvaluasi(Request $request){
        $penilaianController = new PenilaianController();
        $pegawai = $penilaianController->getPegawaiWhoLogin();

        $data = [
            'title' => 'Laporan Kinerja',
            'pegawai' => $pegawai,
            'ttd_pegawai_date' => $request->ttd_pegawai_date,
            'ttd_pejabat_date' => $request->ttd_pejabat_date,
            'margin_top'    => $request->margin_top,
            'margin_bottom' => $request->margin_bottom,
            'margin_left'   => $request->margin_left,
            'margin_right'  => $request->margin_right,
            'position' => $request->position
        ];
        $pdf = Pdf::loadView('penilaian::cetak-dokevaluasi-page', $data)
        ->setPaper('a4', $request->position);

        return $pdf->download('laporan.pdf');
    }
}
