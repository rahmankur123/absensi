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

    // bulan ini
    $bulan = Carbon::now()->month;
    $tahun = Carbon::now()->year;

    $hadir = Kehadiran::where('status','hadir')
        ->whereHas('absensi', function($q) use ($bulan,$tahun){
            $q->whereMonth('tanggal',$bulan)
              ->whereYear('tanggal',$tahun);
        })->count();

    $tidak = Kehadiran::where('status','tidak_hadir')->count();

    $recentAbsensi = Absensi::latest()->take(5)->get();

    return view('dashboard.admin', compact(
        'totalAtlet','totalLatihan','totalPrestasi',
        'hadir','tidak','recentAbsensi', 'name'
    ));
}

public function pelatih()
{
    $totalAtlet = Atlet::count();
    $totalLatihan = Absensi::count();

    $today = Carbon::today();

    $absensiHariIni = Absensi::whereDate('tanggal',$today)->first();

    $hadirHariIni = 0;

    if ($absensiHariIni) {
        $hadirHariIni = Kehadiran::where('absensi_id',$absensiHariIni->id)
            ->where('status','hadir')
            ->count();
    }

    $recent = Absensi::latest()->take(5)->get();

    return view('dashboard.pelatih', compact(
        'totalAtlet','totalLatihan','absensiHariIni','hadirHariIni','recent'
    ));
}
public function atlet()
{
    $user = auth()->user();
    $atlet = $user->atlet;

    $totalLatihan = Kehadiran::where('atlet_id',$atlet->id)->count();

    $hadir = Kehadiran::where('atlet_id',$atlet->id)
        ->where('status','hadir')->count();

    $izin = Kehadiran::where('atlet_id',$atlet->id)
        ->where('status','izin')->count();

    $prestasi = Prestasi::where('atlet_id',$atlet->id)->count();

    $recent = Kehadiran::with('absensi')
        ->where('atlet_id',$atlet->id)
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard.atlet', compact(
        'totalLatihan','hadir','izin','prestasi','recent'
    ));
}
}
