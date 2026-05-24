<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atlet;
use App\Models\Absensi;
use App\Models\Kehadiran;
use App\Models\Prestasi;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{


public function admin()
{
    $name = Auth::user()->name;

    $totalAtlet = Atlet::count();
    $totalLatihan = Absensi::count();
    $totalPrestasi = Prestasi::count();

    // BULAN INI
    $bulan = Carbon::now()->month;
    $tahun = Carbon::now()->year;

    $hadir = Kehadiran::where('status', 'hadir')
        ->whereHas('absensi', function ($q) use ($bulan, $tahun) {
            $q->whereMonth('tanggal', $bulan)
              ->whereYear('tanggal', $tahun);
        })
        ->count();

    $tidak = Kehadiran::where('status', 'tidak_hadir')
        ->whereHas('absensi', function ($q) use ($bulan, $tahun) {
            $q->whereMonth('tanggal', $bulan)
              ->whereYear('tanggal', $tahun);
        })
        ->count();

    $izin = Kehadiran::where('status', 'izin')
        ->whereHas('absensi', function ($q) use ($bulan, $tahun) {
            $q->whereMonth('tanggal', $bulan)
              ->whereYear('tanggal', $tahun);
        })
        ->count();

    // RECENT ABSENSI
    $recentAbsensi = Absensi::with(['jadwal', 'kehadiran'])
        ->latest()
        ->take(5)
        ->get()
        ->map(function ($item) {

            $item->hadir = $item->kehadiran
                ->where('status', 'hadir')
                ->count();

            $item->izin = $item->kehadiran
                ->where('status', 'izin')
                ->count();

            $item->tidak = $item->kehadiran
                ->where('status', 'tidak_hadir')
                ->count();

            return $item;
        });

    return view('dashboard.admin', compact(
        'totalAtlet',
        'totalLatihan',
        'totalPrestasi',
        'hadir',
        'tidak',
        'izin',
        'recentAbsensi',
        'name'
    ));
}

public function pelatih()
{
    $name = Auth::user()->name;

    $totalAtlet = Atlet::count();
    $totalLatihan = Absensi::count();
    $totalPrestasi = Prestasi::count();

    // BULAN INI
    $bulan = Carbon::now()->month;
    $tahun = Carbon::now()->year;

    $hadir = Kehadiran::where('status', 'hadir')
        ->whereHas('absensi', function ($q) use ($bulan, $tahun) {
            $q->whereMonth('tanggal', $bulan)
              ->whereYear('tanggal', $tahun);
        })
        ->count();

    $tidak = Kehadiran::where('status', 'tidak_hadir')
        ->whereHas('absensi', function ($q) use ($bulan, $tahun) {
            $q->whereMonth('tanggal', $bulan)
              ->whereYear('tanggal', $tahun);
        })
        ->count();

    $izin = Kehadiran::where('status', 'izin')
        ->whereHas('absensi', function ($q) use ($bulan, $tahun) {
            $q->whereMonth('tanggal', $bulan)
              ->whereYear('tanggal', $tahun);
        })
        ->count();

    // RECENT ABSENSI
    $recentAbsensi = Absensi::with(['jadwal', 'kehadiran'])
        ->latest()
        ->take(5)
        ->get()
        ->map(function ($item) {

            $item->hadir = $item->kehadiran
                ->where('status', 'hadir')
                ->count();

            $item->izin = $item->kehadiran
                ->where('status', 'izin')
                ->count();

            $item->tidak = $item->kehadiran
                ->where('status', 'tidak_hadir')
                ->count();

            return $item;
        });

    return view('dashboard.pelatih', compact(
        'totalAtlet',
        'totalLatihan',
        'totalPrestasi',
        'hadir',
        'tidak',
        'izin',
        'recentAbsensi',
        'name'
    ));
}

public function atlet()
{
    $name = Auth::user()->name;

    $atlet = Atlet::where('user_id', Auth::id())->first();

    // TOTAL LATIHAN MILIK ATLET
    $totalLatihan = Kehadiran::where('atlet_id', $atlet->id)->count();

    // BULAN INI
    $bulan = Carbon::now()->month;
    $tahun = Carbon::now()->year;

    // HADIR
    $hadir = Kehadiran::where('atlet_id', $atlet->id)
        ->where('status', 'hadir')
        ->whereHas('absensi', function ($q) use ($bulan, $tahun) {

            $q->whereMonth('tanggal', $bulan)
              ->whereYear('tanggal', $tahun);

        })
        ->count();

    // TIDAK HADIR
    $tidak = Kehadiran::where('atlet_id', $atlet->id)
        ->where('status', 'tidak_hadir')
        ->whereHas('absensi', function ($q) use ($bulan, $tahun) {

            $q->whereMonth('tanggal', $bulan)
              ->whereYear('tanggal', $tahun);

        })
        ->count();

    // IZIN
    $izin = Kehadiran::where('atlet_id', $atlet->id)
        ->where('status', 'izin')
        ->whereHas('absensi', function ($q) use ($bulan, $tahun) {

            $q->whereMonth('tanggal', $bulan)
              ->whereYear('tanggal', $tahun);

        })
        ->count();

    // PRESTASI
    $prestasi = Prestasi::where('atlet_id', $atlet->id)->count();

    // RIWAYAT LATIHAN
    $recent = Kehadiran::with('absensi')
        ->where('atlet_id', $atlet->id)
        ->whereHas('absensi')
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard.atlet', compact(
        'totalLatihan',
        'hadir',
        'tidak',
        'izin',
        'prestasi',
        'recent',
        'name'
    ));
}
}
