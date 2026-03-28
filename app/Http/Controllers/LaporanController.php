<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\Atlet;
use App\Models\Kehadiran;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class LaporanController extends Controller
{

    public function index(Request $request)
    {
        $query = Absensi::with('jadwal','kehadiran');

        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        $query->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun);

        $data = $query->latest()->paginate(10);

        return view('laporan.index', compact('data','bulan','tahun'));
    }

    public function rekapAtletDetail(Request $request, $id)
    {
        $atlet = Atlet::with('user')->findOrFail($id);

        $query = Kehadiran::with('absensi.jadwal')
            ->where('atlet_id', $id);

        // OPTIONAL FILTER BULAN
        if ($request->bulan && $request->tahun) {
            $query->whereHas('absensi', function ($q) use ($request) {
                $q->whereMonth('tanggal', $request->bulan)
                ->whereYear('tanggal', $request->tahun);
            });
        }

        $data = $query->latest()->get();

        return view('laporan.rekap_atlet', compact('atlet','data'));
    }
    public function cetak($bulan, $tahun)
{
    $data = Absensi::with('jadwal','kehadiran')
        ->whereMonth('tanggal', $bulan)
        ->whereYear('tanggal', $tahun)
        ->get();

    $pdf = Pdf::loadView('laporan.pdf', compact('data','bulan','tahun'));

    return $pdf->download('laporan-'.$bulan.'-'.$tahun.'.pdf');
}
public function cetakRekap($atlet_id)
{
    $atlet = Atlet::with('user')->findOrFail($atlet_id);

    $data = Kehadiran::with('absensi.jadwal')
        ->where('atlet_id', $atlet_id)
        ->get(); 

    $pdf = Pdf::loadView('laporan.rekap_pdf', compact('data','atlet'));

    return $pdf->download('rekap-'.$atlet->user->nama.'.pdf');
}

}
