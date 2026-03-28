<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Kehadiran;
use App\Models\Jadwal;
use App\Models\Atlet;

class AtletDashboardController extends Controller
{
    public function riwayat(Request $request)
{
    $user = auth()->user();
    $atlet = Atlet::where('user_id', $user->id)->first();

    $query = Kehadiran::with('absensi.jadwal')
        ->where('atlet_id', $atlet->id);

    if ($request->search) {
        $query->whereHas('absensi.jadwal', function($q) use ($request){
            $q->where('hari', 'like', '%'.$request->search.'%');
        });
    }

    $data = $query->latest()->paginate(10);

    return view('atlet.riwayat.index', compact('data'));
}

    public function absensi(Request $request)
{
    $user = auth()->user();
    $atlet = Atlet::where('user_id', $user->id)->first();

    $query = Kehadiran::with('absensi.jadwal')
        ->where('atlet_id', $atlet->id)
        ->whereHas('absensi', function($q){
            $q->where('status', 'buka');
        });

    if ($request->search) {
        $query->whereHas('absensi.jadwal', function($q) use ($request){
            $q->where('hari', 'like', '%'.$request->search.'%');
        });
    }

    $data = $query->latest()->paginate(10);

    return view('atlet.absensi.index', compact('data'));
}

public function formAbsensi($id)
{
    $data = Kehadiran::with('absensi.jadwal')->findOrFail($id);

    return view('atlet.absensi.form', compact('data'));
}

public function submitAbsensi(Request $request, $id)
{
    $data = Kehadiran::findOrFail($id);

    $request->validate([
        'status' => 'required',
        'bukti' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
    ]);

    if ($request->status == 'izin') {
        if ($request->hasFile('bukti')) {
            $path = $request->file('bukti')->store('bukti_absensi', 'public');
            $data->bukti = $path;
        }
    }

    $data->status = $request->status;
    $data->save();

    return redirect('/atlet/absensi')->with('success', 'Absensi berhasil');
}
public function profil(Request $request)
{
    $user = auth()->user();
    $atlet = $user->atlet;

    $mode = $request->mode == 'edit' ? 'edit' : 'view';

    return view('atlet.profil', compact('user','atlet','mode'));
}

public function updateProfil(Request $request)
{
    $user = auth()->user();
    $atlet = $user->atlet;

    $data = $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'no_hp' => 'required',

        // DATA ATLET
        'tanggal_lahir' => 'required|date',
        'jenis_kelamin' => 'required',
        'alamat' => 'required',
        'berat_badan' => 'required|numeric',
        'tinggi_badan' => 'required|numeric',

        'foto' => 'nullable|image|max:2048'
    ]);

    // upload foto
    if ($request->hasFile('foto')) {
        $path = $request->file('foto')->store('foto_user', 'public');
        $user->foto = $path;
    }

    // UPDATE USER
    $user->update([
        'nama' => $data['nama'],
        'email' => $data['email'],
        'no_hp' => $data['no_hp'],
        'foto' => $user->foto
    ]);

    // 🔥 UPDATE ATLET (INI YANG KURANG)
    $atlet->update([
        'tanggal_lahir' => $data['tanggal_lahir'],
        'jenis_kelamin' => $data['jenis_kelamin'],
        'alamat' => $data['alamat'],
        'berat_badan' => $data['berat_badan'],
        'tinggi_badan' => $data['tinggi_badan'],
    ]);

    return back()->with('success','Profil berhasil diperbarui');
}
public function jadwal(Request $request)
{
    $query = Jadwal::query();

    if ($request->search) {
        $query->where('hari', 'like', '%'.$request->search.'%');
    }

    $data = $query->orderBy('hari')->paginate(10);

    return view('atlet.jadwal.index', compact('data'));
}
}