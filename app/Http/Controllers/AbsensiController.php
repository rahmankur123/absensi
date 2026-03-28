<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kehadiran;
use App\Models\Atlet;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index(Request $request)
{
    $query = Absensi::with('jadwal')
        ->withCount([
            'kehadiran as hadir_count' => fn($q) => $q->where('status', 'hadir'),
            'kehadiran as izin_count' => fn($q) => $q->where('status', 'izin'),
            'kehadiran as tidak_hadir_count' => fn($q) => $q->where('status', 'tidak_hadir'),
        ]);

    if ($request->search) {
        $query->whereHas('jadwal', function($q) use ($request){
            $q->where('hari', 'like', '%'.$request->search.'%');
        });
    }

    $absensis = $query->latest()->paginate(10);

    return view('pelatih.absensi.index', compact('absensis'));
}
    public function create()
{
    $jadwal = Jadwal::all();

    return view('pelatih.absensi.create', compact('jadwal'));
}

    public function store(Request $request)
{
    $request->validate([
        'jadwal_id' => 'required',
        'tanggal' => 'required|date',
    ]);

    $absensi = Absensi::create([
        'jadwal_id' => $request->jadwal_id,
        'tanggal' => $request->tanggal,
        'status' => true
    ]);

    // 🔥 AUTO GENERATE KEHADIRAN
    $atlets = Atlet::all();

    foreach ($atlets as $atlet) {
        Kehadiran::create([
            'absensi_id' => $absensi->id,
            'atlet_id' => $atlet->id,
            'status' => 'tidak_hadir'
        ]);
    }

    return redirect()->route('pelatih.absensi.index')
        ->with('success', 'Absensi berhasil dibuat');
}

    public function detail(Request $request, $id)
{
    $data = Absensi::with('jadwal','kehadiran.atlet.user')->findOrFail($id);

    $mode = $request->mode == 'edit' ? 'edit' : 'view';

    return view('pelatih.absensi.detail', compact('data','mode'));
}

    public function update(Request $request, $id)
{
    $absensi = Absensi::findOrFail($id);

    if (!$absensi->status) {
        return back()->with('error', 'Absensi sudah ditutup');
    }

    foreach ($request->status as $kehadiran_id => $status) {

    $data = Kehadiran::find($kehadiran_id);

    if ($data) {

        $data->status = $status;

        // evaluasi hanya jika hadir
        if ($status == 'hadir') {
            $data->evaluasi_teknik = $request->evaluasi_teknik[$kehadiran_id] ?? null;
            $data->evaluasi_fisik = $request->evaluasi_fisik[$kehadiran_id] ?? null;
            $data->evaluasi_mental = $request->evaluasi_mental[$kehadiran_id] ?? null;
        } else {
            $data->evaluasi_teknik = null;
            $data->evaluasi_fisik = null;
            $data->evaluasi_mental = null;
        }

        // upload bukti
        if ($request->hasFile("bukti.$kehadiran_id")) {
            $path = $request->file("bukti.$kehadiran_id")
                ->store('bukti_absensi', 'public');

            $data->bukti = $path;
        }

        $data->save();
    }
}

    return back()->with('success', 'Evaluasi berhasil disimpan');
}

public function toggle($id)
{
    $absensi = Absensi::findOrFail($id);

    $absensi->status = $absensi->status == 'buka' ? 'tutup' : 'buka';

    $absensi->save();

    return back()->with('success', 'Status diubah');
}
 public function delete($id)
{
    $absensi = Absensi::findOrFail($id);

    // hapus kehadiran dulu
    $absensi->kehadiran()->delete();

    $absensi->delete();

    return redirect('/pelatih/absensi');
}
}