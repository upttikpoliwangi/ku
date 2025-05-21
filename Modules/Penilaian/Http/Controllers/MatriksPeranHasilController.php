<?php

namespace Modules\Penilaian\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Pengaturan\Entities\Anggota;
use Modules\Pengaturan\Entities\Pegawai;
use Modules\Penilaian\Entities\Cascading;
use Modules\Penilaian\Entities\RencanaKerja;

class MatriksPeranHasilController extends Controller
{
    protected $penilaianController;
    protected $periodeController;

    public function __construct(PenilaianController $penilaianController, PeriodeController $periodeController) {
        $this->penilaianController = $penilaianController;
        $this->periodeController = $periodeController;
    }

    public function matriksperanhasil(Request $request){
        $pegawai = $this->penilaianController->getPegawaiWhoLogin();
        $rencana = RencanaKerja::with('hasilKerja.indikator')->where('pegawai_id', $pegawai->id)->first();

        if($request->query('params') == 'json') return response()->json($rencana);
        else return view('penilaian::matriksperanhasil', compact('rencana'));
    }

    public function storeCascading (Request $request, $id) {
        try {
            $cascadings = $request->cascading;
            foreach($cascadings as $cascading) {
                Cascading::create([
                    'indikator_id' => $id,
                    'pegawai_id' => $cascading
                ]);
            }
            return redirect()->back()->with('success', 'Tambah cascading berhasil');
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function getAnggota(Request $request) {
        try {
            $pegawaiWhoLogin = $this->penilaianController->getPegawaiWhoLogin();
            $username = $pegawaiWhoLogin->username;
            $pegawai = Pegawai::with([
                'timKerjaAnggota' => function ($query) {
                    $query->wherePivot('peran', 'Ketua');
                },
                'rencanaKerja.hasilKerja',
                'timKerjaAnggota',
                'timKerjaAnggota.unit',
                'timKerjaAnggota.subUnits.unit',
                'timKerjaAnggota.parentUnit.unit',
            ])->where('username', $username)->first();

            if($pegawai->timKerjaAnggota[0]->parentUnit != null){
                $atasan = $pegawai->timKerjaAnggota[0]->parentUnit->ketua->pegawai;
            }

            $timKerjaId = $pegawai->timKerjaAnggota[0]->id;

            $bawahan = Anggota::with(['timKerja', 'pegawai'])
            ->where(function ($query) use ($timKerjaId) {
                $query->whereHas('timKerja', function ($q) use ($timKerjaId) {
                        $q->where('parent_id', $timKerjaId);
                    }
                )->orWhere(function ($q) use ($timKerjaId) {
                        $q->whereHas('timKerja', function ($sub) use ($timKerjaId) {
                            $sub->where('id', $timKerjaId);
                        })->where('peran', '!=', 'Ketua');
                    }
                );
            })->paginate(10);

            if($request->query('params') == 'json'){
                return response()->json([
                    'bawahan' => $bawahan
                ]);
            }

            return response()->json([
                'status' => 'success',
                'draw' => $request->draw,
                'recordsTotal' => $bawahan->total(),
                'recordsFiltered' => $bawahan->total(),
                'data' => $bawahan->items()
            ]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
