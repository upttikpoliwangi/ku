<?php

namespace Modules\Penilaian\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Modules\Pengaturan\Entities\Pegawai;
use Modules\Penilaian\Entities\Periode;
use Illuminate\Support\Facades\Auth;
use Modules\Penilaian\Entities\PeriodeAktif;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function boot(){
        view::composer('penilaian::components.set-periode', function($view){
            $authUser = Auth::user();
            $pegawaiId = $authUser->pegawai->id;
            $pegawai = Pegawai::with([
                'pejabat.jabatan',
                'timKerjaAnggota',
                'timKerjaAnggota.unit',
                'timKerjaAnggota.subUnits.unit',
                'timKerjaAnggota.parentUnit.unit',
            ])->where('id', '=', $pegawaiId)->first();

            $periodeAktif = PeriodeAktif::with('periode')->where('pegawai_id', $pegawai->id)->first();

            $timKerja = $pegawai->timKerjaAnggota;
            $view->with([
                'periode' => Periode::all(),
                'pegawai' => $pegawai,
                'timKerja' => $timKerja,
                'periodeAktif' => $periodeAktif?->periode,
            ]);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
