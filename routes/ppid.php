<?php
use Illuminate\Support\Facades\Route;
use Modules\Ppid\Http\Controllers\PermohonaninformasiController;

Route::middleware(['auth', 'permission'])
    ->prefix('ppid')
    ->group(function () {
        // Route untuk Data Pemohon (admin)
        Route::get('/datapemohon', [PermohonaninformasiController::class, 'datapemohonIndex'])->name('datapemohon.index');
        Route::get('/datapemohon/create', [PermohonaninformasiController::class, 'create'])->name('datapemohon.create');
        Route::post('/datapemohon', [PermohonaninformasiController::class, 'store'])->name('datapemohon.store');
        Route::get('/datapemohon/{id}/edit', [PermohonaninformasiController::class, 'edit'])->name('datapemohon.edit');
        Route::put('/datapemohon/{id}', [PermohonaninformasiController::class, 'update'])->name('datapemohon.update');
        Route::delete('/datapemohon/{id}', [PermohonaninformasiController::class, 'destroy'])->name('datapemohon.destroy');
    });
