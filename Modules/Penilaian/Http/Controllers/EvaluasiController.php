<?php

namespace Modules\Penilaian\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Pengaturan\Entities\Pegawai;
use Modules\Pengaturan\Entities\Anggota;
use Illuminate\Support\Facades\DB;
use Modules\Pengaturan\Entities\Pejabat;
use Modules\Penilaian\Entities\HasilKerja;
use Modules\Penilaian\Entities\PenilaianHasilKerja;
use Modules\Penilaian\Entities\PenilaianPerilakuKerja;
use Modules\Penilaian\Entities\RencanaKerja;
use Modules\Penilaian\Entities\RencanaPerilaku;

class EvaluasiController extends Controller {

    protected $penilaianController;
    protected $periodeController;

    public function __construct(PenilaianController $penilaianController, PeriodeController $periodeController) {
        $this->penilaianController = $penilaianController;
        $this->periodeController = $periodeController;
    }

    public function predikatKinerja($hasilKerja, $perilaku) {
        $hasilKerjaMap = [ 'Dibawah Ekspektasi' => 1, 'Sesuai Ekspektasi' => 2, 'Diatas Ekspektasi' => 3 ];
        $perilakuMap = [ 'Dibawah Ekspektasi' => 1, 'Sesuai Ekspektasi' => 2, 'Diatas Ekspektasi' => 3 ];

        $hasilKerjaValue = $hasilKerjaMap[$hasilKerja] ?? null;
        $perilakuValue = $perilakuMap[$perilaku] ?? null;

        $matrix = [
            1 => [
                1 => 'Sangat Kurang',
                2 => 'Butuh Perbaikan',
                3 => 'Butuh Perbaikan',
            ],
            2 => [
                1 => 'Kurang',
                2 => 'Baik',
                3 => 'Baik',
            ],
            3 => [
                1 => 'Kurang',
                2 => 'Baik',
                3 => 'Sangat Baik',
            ],
        ];

        $result = ($hasilKerjaValue && $perilakuValue) ? ($matrix[$hasilKerjaValue][$perilakuValue] ?? 'Data tidak valid') : 'Data tidak valid';

        return $result;
    }

    public function evaluasi() {
        return view('penilaian::evaluasi');
    }

    public function evaluasiDetail(Request $request, $username) {
        $params = $request->query('params');
        $pegawaiWhoLogin = $this->penilaianController->getPegawaiWhoLogin();
        $periodeId = $this->periodeController->periode_aktif();
        $pegawai = Pegawai::with(['timKerjaAnggota','rencanaKerja.hasilKerja',
            'timKerjaAnggota.unit', 'timKerjaAnggota.subUnits.unit','timKerjaAnggota.parentUnit.unit',
        ])->where('username', '=', $username)->first();

        $rencana = RencanaKerja::with([
            'hasilKerja.parent.rencanakerja',
            'hasilKerja.parent',
            'perilakuKerja',
            'hasilKerja.penilaianHasilKerja' => function ($query) use ($pegawaiWhoLogin){
                $query->where('ketua_tim_id', $pegawaiWhoLogin->id);
            },
            'perilakuKerja.rencanaPerilaku.penilaianPerilakuKerja' => function ($query) use ($pegawaiWhoLogin){
                $query->where('ketua_tim_id', $pegawaiWhoLogin->id);
            },'hasilKerja' => function ($query) use ($pegawaiWhoLogin) {
                $query->whereHas('parent.rencanakerja', function ($q) use ($pegawaiWhoLogin) {
                    $q->where('pegawai_id', $pegawaiWhoLogin->id);
                })->orWhereNull('parent_hasil_kerja_id');
            },
            'perilakuKerja' => function ($query) use ($periodeId, $pegawai) {
                $query->with(['rencanaPerilaku' => function ($q) use ($periodeId, $pegawai) {
                    $q->whereHas('rencanakerja', function ($qr) use ($periodeId, $pegawai) {
                        $qr->where('periode_id', $periodeId)
                        ->where('pegawai_id', $pegawai->id);
                    });
                }]);
            }])->where('periode_id', $periodeId)->where('pegawai_id', '=', $pegawai->id)->first();

        $hasiKerjaRecommendation = $this->hasilKerjaRecommendation($rencana, $pegawaiWhoLogin->id);
        $perilakuRecommendation = $this->perilakuRecommendation($rencana->perilakuKerja, $pegawaiWhoLogin->id);

        if($params == 'json') return response()->json([ 'perilakuKerja' => $rencana->perilakuKerja ]);
        else return view('penilaian::evaluasi-detail', compact('pegawaiWhoLogin', 'pegawai', 'rencana', 'hasiKerjaRecommendation', 'perilakuRecommendation'));
    }

    public function index(Request $request){
        try {
            $pegawai = $this->penilaianController->getPegawaiWhoLogin();
            $periodeId = $this->periodeController->periode_aktif();
            $ketua = Pejabat::where('pegawai_id', '=', $pegawai->id)->first();
            $timKerjaId = $pegawai->timKerjaAnggota[0]->id;
            $username = $pegawai->username;

            if($ketua != null) {
                $bawahan = Anggota::with(['timKerja', 'pegawai.rencanakerja' => function ($query) use ($periodeId) {
                    $query->where('periode_id', $periodeId);
                }])->where(function ($query) use ($timKerjaId) {
                    $query->where(function ($q) use ($timKerjaId) {
                        $q->whereHas('timKerja', function ($sub) use ($timKerjaId) {
                            $sub->where('parent_id', $timKerjaId);
                        })->where('peran', 'Ketua');
                    })->orWhere(function ($q) use ($timKerjaId) {
                        $q->whereHas('timKerja', function ($sub) use ($timKerjaId) {
                            $sub->where('id', $timKerjaId);
                        })->where('peran', 'Anggota');
                    });
                })->whereHas('pegawai', function ($q) use ($username) {
                    $q->where('username', '!=', $username);
                })->paginate(10);

                return response()->json([
                    'status' => 'success',
                    'draw' => $request->draw,
                    'recordsTotal' => $bawahan->total(),
                    'recordsFiltered' => $bawahan->total(),
                    'data' => $bawahan->items()
                ]);
            }else {
                return response()->json([
                    'status' => 'success',
                    'draw' => $request->draw,
                    'recordsTotal' => 0,
                    'recordsFiltered' => 0,
                    'data' => [],
                    'message' => 'No data available'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }

    public function prosesUmpanBalik(Request $request, $username){
        $periodeId = $this->periodeController->periode_aktif();
        $pegawaiWhoLogin = $this->penilaianController->getPegawaiWhoLogin();
        DB::beginTransaction();
        try {
            foreach ($request->feedback as $item) {
                PenilaianHasilKerja::updateOrCreate([
                        'hasil_kerja_id' => $item['hasil_kerja_id'],
                        'ketua_tim_id' => $pegawaiWhoLogin->id,
                    ],
                    [
                        'umpan_balik_predikat' => $item['umpan_balik_predikat'],
                        'umpan_balik_deskripsi' => $item['umpan_balik_deskripsi'] ?? null,
                    ]
                );
            }
            foreach ($request->feedback_perilaku_kerja as $item) {
                PenilaianPerilakuKerja::updateOrCreate([
                        'rencana_perilaku_id' => $item['perilaku_kerja_id'],
                        'ketua_tim_id' => $pegawaiWhoLogin->id,
                    ],
                    [
                        'umpan_balik_predikat' => $item['perilaku_umpan_balik_predikat'],
                        'umpan_balik_deskripsi' => $item['perilaku_umpan_balik_deskripsi'] ?? null,
                    ]);
            }
            DB::commit();
            return redirect()->back()->with('success', 'proses umpan balik berhasil');
        } catch (\Throwable $th) {
            // DB::rollBack();
            return response()->json($th->getMessage());
        }
    }

    public function simpanHasilEvaluasi(Request $request, $id) {
        $periodeId = $this->periodeController->periode_aktif();
        $requestEvaluasi = [
            'status_realisasi' => 'Sudah Dievaluasi',
            'rating_hasil_kerja' => $request->rating_hasil_kerja,
            'deskripsi_rating_hasil_kerja' => $request->deskripsi_rating_hasil_kerja,
            'rating_perilaku' => $request->rating_perilaku,
            'deskripsi_rating_perilaku' => $request->deskripsi_rating_perilaku,
            'predikat_akhir' => $this->predikatKinerja($request->rating_hasil_kerja, $request->rating_perilaku)
        ];

        try {
            RencanaKerja::where('pegawai_id', $id)->where('periode_id', $periodeId)->update($requestEvaluasi);
            return redirect()->back()->with('success', 'berhasil ditambahkan');
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ]);
        }
    }

    private function hasilKerjaRecommendation($rencana, $ketuaId){
        $arr = $rencana->hasilKerja->map(function ($item) use ($ketuaId) {
            $penilaian = $item->penilaianHasilKerja
                ->firstWhere('ketua_tim_id', $ketuaId);
            return $this->predikatValue($penilaian->umpan_balik_predikat ?? null);
        });

        $filtered = $arr->filter();
        if ($filtered->isEmpty()) {
            return null;
        }

        $value = $filtered->sum();
        $average = $value / $filtered->count();

        return $this->predikatValue($average);
    }

    private function perilakuRecommendation($perilakuKerja, $ketuaId){
        $arr = $perilakuKerja->map(function ($item) use ($ketuaId) {
            $penilaian = $item->rencanaPerilaku->penilaianPerilakuKerja->firstWhere('ketua_tim_id', $ketuaId);
            return $this->predikatValue($penilaian->umpan_balik_predikat ?? null);
        });

        $filtered = $arr->filter();
        if ($filtered->isEmpty()) {
            return null;
        }

        $value = $filtered->sum();
        $average = $value / $filtered->count();

        return $this->predikatValue($average);
    }

    private function predikatValue($input){
        $map = [
            'Dibawah Ekspektasi' => 1,
            'Sesuai Ekspektasi' => 2,
            'Diatas Ekspektasi' => 3,
        ];

        if (is_string($input)) {
            return $map[$input] ?? 0;
        }

        if (is_numeric($input)) {
            $intValue = round($input);
            $result = array_search(intval($intValue), $map, true);
            return $result ?: 0;
        }

        return 0;
    }
}
