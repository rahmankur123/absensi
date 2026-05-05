<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Kehadiran;
use App\Models\Jadwal;
use App\Models\Atlet;

class AtletDashboardController extends Controller
{
    // ===============================
    // RIWAYAT ABSENSI
    // ===============================
    public function riwayat(Request $request)
    {
        $user = Auth::user();
        $atlet = $user->atlet;

        if (!$atlet) {
            abort(404, 'Data atlet tidak ditemukan');
        }

        $query = Kehadiran::with('absensi.jadwal')
            ->where('atlet_id', $atlet->id);

        if ($request->search) {
            $query->whereHas('absensi.jadwal', function ($q) use ($request) {
                $q->where('hari', 'like', '%' . $request->search . '%');
            });
        }

        $data = $query->latest()->paginate(10);

        return view('atlet.riwayat', compact('data'));
    }

    // ===============================
    // LIST ABSENSI AKTIF
    // ===============================
    public function absensi(Request $request)
    {
        $user = Auth::user();
        $atlet = $user->atlet;

        if (!$atlet) {
            abort(404, 'Data atlet tidak ditemukan');
        }

        $query = Kehadiran::with('absensi.jadwal')
            ->where('atlet_id', $atlet->id)
            ->whereHas('absensi', function ($q) {
                $q->where('status', 'buka');
            });

        if ($request->search) {
            $query->whereHas('absensi.jadwal', function ($q) use ($request) {
                $q->where('hari', 'like', '%' . $request->search . '%');
            });
        }

        $data = $query->latest()->paginate(10);

        return view('atlet.absensi.index', compact('data'));
    }

    // ===============================
    // FORM ABSENSI
    // ===============================
    public function formAbsensi($id)
    {
        $user = Auth::user();
        $atlet = $user->atlet;

        $data = Kehadiran::with('absensi.jadwal')
            ->where('id', $id)
            ->where('atlet_id', $atlet->id) // 🔥 security
            ->firstOrFail();

        return view('atlet.absensi.form', compact('data'));
    }

    // ===============================
    // SUBMIT ABSENSI
    // ===============================
    public function submitAbsensi(Request $request, $id)
    {
        $user = Auth::user();
        $atlet = $user->atlet;

        $data = Kehadiran::where('id', $id)
            ->where('atlet_id', $atlet->id) // 🔥 security
            ->firstOrFail();

        // 🔥 cegah submit ulang
        if ($data->status != null) {
            return back()->with('error', 'Absensi sudah diisi');
        }

        $request->validate([
            'status' => 'required|in:hadir,izin',
            'bukti' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // upload bukti (hadir & izin)
        if (in_array($request->status, ['hadir', 'izin'])) {
            if ($request->hasFile('bukti')) {
                $path = $request->file('bukti')->store('bukti_absensi', 'public');
                $data->bukti = $path;
            }
        }

        $data->status = $request->status;
        $data->save();

        return redirect('/atlet/absensi')->with('success', 'Absensi berhasil dikirim');
    }

    // ===============================
    // PROFIL
    // ===============================
    public function profil(Request $request)
    {
        $user = Auth::user();
        $atlet = $user->atlet;

        $mode = $request->mode == 'edit' ? 'edit' : 'view';

        return view('atlet.profil', compact('user', 'atlet', 'mode'));
    }

    // ===============================
    // UPDATE PROFIL
    // ===============================
    public function updateProfil(Request $request)
    {
        $user = Auth::user();
        $atlet = $user->atlet;

        $data = $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'required',

            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // hapus foto lama + upload baru
        if ($request->hasFile('foto')) {

            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }

            $path = $request->file('foto')->store('foto_user', 'public');
            $user->foto = $path;
        }

        // update user
        $user->update([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'no_hp' => $data['no_hp'],
            'foto' => $user->foto
        ]);

        // update atlet
        if ($atlet) {
            $atlet->update([
                'tanggal_lahir' => $data['tanggal_lahir'],
                'jenis_kelamin' => $data['jenis_kelamin'],
                'alamat' => $data['alamat'],
                'berat_badan' => $data['berat_badan'],
                'tinggi_badan' => $data['tinggi_badan'],
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui');
    }

    // ===============================
    // JADWAL LATIHAN
    // ===============================
    public function jadwal(Request $request)
    {
        $query = Jadwal::query();

        if ($request->search) {
            $query->where('hari', 'like', '%' . $request->search . '%');
        }

        // urutan hari rapi
        $query->orderByRaw("
            FIELD(hari, 'senin','selasa','rabu','kamis','jumat','sabtu','minggu')
        ");

        $data = $query->paginate(10);

        return view('atlet.jadwal', compact('data'));
    }
}