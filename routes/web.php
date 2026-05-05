<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AtletController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\AtletDashboardController;
use App\Http\Controllers\Atlet\PrestasiController;
use App\Http\Controllers\admin\AdminPrestasiController;
use App\Http\Controllers\DashboardController;
use Symfony\Component\Routing\Annotation\Route as AnnotationRoute;

Route::middleware(['auth', 'role:admin'])->get('/admin', [DashboardController::class, 'admin']);
Route::middleware(['auth', 'role:pelatih'])->get('/pelatih', [DashboardController::class, 'pelatih']);
Route::middleware(['auth', 'role:atlet'])->get('/atlet', [DashboardController::class, 'atlet']);



Route::get('/', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'prosesLogin']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/set-role/{role}', function ($role) {
    session(['role' => $role]);
    return redirect('/');});

    Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/atlet', [AtletController::class, 'index']);
    Route::get('/atlet/create', [AtletController::class, 'create']);
    Route::post('/atlet/store', [AtletController::class, 'store']);
    Route::get('/atlet/edit/{id}', [AtletController::class, 'edit']);
    Route::post('/atlet/update/{id}', [AtletController::class, 'update']);
    Route::get('/atlet/delete/{id}', [AtletController::class, 'delete']);

    Route::get('/jadwal', [JadwalController::class, 'index']);
    Route::get('/jadwal/create', [JadwalController::class, 'create']);
    Route::post('/jadwal/store', [JadwalController::class, 'store']);
    Route::get('/jadwal/edit/{id}', [JadwalController::class, 'edit']);
    Route::post('/jadwal/update/{id}', [JadwalController::class, 'update']);
    Route::get('/jadwal/delete/{id}', [JadwalController::class, 'delete']);


    Route::get('/prestasi', [AdminPrestasiController::class, 'index']);
    Route::get('/prestasi/approve/{id}', [AdminPrestasiController::class, 'approve']);
    Route::get('/prestasi/reject/{id}', [AdminPrestasiController::class, 'reject']);

    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/rekap-atlet/{id}', [LaporanController::class, 'rekapAtletDetail']);
});

Route::middleware(['auth','role:pelatih'])->prefix('pelatih')->group(function () {

    Route::get('/absensi', [AbsensiController::class, 'index']);
    Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('pelatih.absensi.create');
    Route::post('/absensi/store', [AbsensiController::class, 'store'])->name('pelatih.absensi.store');
    Route::get('/absensi/detail/{id}', [AbsensiController::class, 'detail'])->name('pelatih.absensi.detail');
    Route::delete('/absensi/delete/{id}', [AbsensiController::class, 'delete'])->name('pelatih.absensi.delete');
    Route::post('/absensi/update/{id}', [AbsensiController::class, 'update'])->name('pelatih.absensi.update');
    Route::get('/absensi/toggle/{id}', [AbsensiController::class, 'toggle'])
        ->name('pelatih.absensi.toggle');
    Route::get('/atlet', [AtletController::class, 'indexpelatih']);
    Route::get('/atlet/{id}', [AtletController::class, 'detailpelatih']);

    

    Route::get('/laporan', [LaporanController::class, 'index']);
    Route::get('/rekap-atlet/{id}', [LaporanController::class, 'rekapAtletDetail']);

});

Route::middleware(['auth','role:atlet'])->prefix('atlet')->group(function () {
    Route::get('/riwayat', [AtletDashboardController::class, 'riwayat'])->name('atlet.riwayat');

    Route::get('/absensi', [AtletDashboardController::class, 'absensi'])->name('atlet.absensi');
    Route::get('/absensi/{id}', [AtletDashboardController::class, 'formAbsensi'])->name('atlet.absensi.form');
    Route::post('/absensi/{id}', [AtletDashboardController::class, 'submitAbsensi'])->name('atlet.absensi.submit');

    Route::get('/profil', [AtletDashboardController::class, 'profil'])->name('atlet.profil');
    Route::post('/profil/update', [AtletDashboardController::class, 'updateProfil'])->name('atlet.profil.update');

    Route::get('/jadwal', [AtletDashboardController::class, 'jadwal'])->name('atlet.jadwal');

    Route::get('/prestasi', [PrestasiController::class, 'index']);
    Route::get('/prestasi/create', [PrestasiController::class, 'create']);
    Route::post('/prestasi/store', [PrestasiController::class, 'store']);
    Route::get('/prestasi/delete/{id}', [PrestasiController::class, 'delete']);
});


    Route::get('/laporan/cetak/{bulan}/{tahun}', [LaporanController::class, 'cetak']);
    Route::get('/laporan/rekap/cetak/{id}', [LaporanController::class, 'cetakRekap']);