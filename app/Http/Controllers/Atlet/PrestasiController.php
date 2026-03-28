<?php

namespace App\Http\Controllers\Atlet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prestasi;
use App\Models\Atlet;
use Illuminate\Support\Facades\Auth;

class PrestasiController extends Controller
{
    public function index(Request $request)
{
    $user = auth()->user();
    $atlet = Atlet::where('user_id', $user->id)->first();

    $query = Prestasi::where('atlet_id', $atlet->id);

    if ($request->search) {
        $query->where('nama_kejuaraan', 'like', '%'.$request->search.'%');
    }

    $data = $query->latest()->paginate(10);

    return view('atlet.prestasi.index', compact('data'));
}
    public function create()
    {
        return view('atlet.prestasi.create');
    }

    public function store(Request $request)
{
    $user = auth()->user();

    // safety (biar ga error lagi)
    if (!$user->atlet) {
        return back()->with('error', 'Data atlet tidak ditemukan');
    }

    $data = $request->validate([
        'nama_kejuaraan' => 'required',
        'tingkat' => 'required',
        'juara' => 'required',
        'tahun' => 'required|numeric',
        'bukti_prestasi' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        'keterangan' => 'nullable'
    ]);

    // upload file
    if ($request->hasFile('bukti_prestasi')) {
        $data['bukti_prestasi'] = $request->file('bukti_prestasi')
            ->store('prestasi', 'public');
    }

    // ⬇️ WAJIB (relasi atlet)
    $data['atlet_id'] = $user->atlet->id;

    // ⬇️ WAJIB (validasi admin nanti)
    $data['status'] = 'pending';

    Prestasi::create($data);

    return redirect('/atlet/prestasi')
        ->with('success', 'Prestasi berhasil dikirim, menunggu validasi admin');
}

    public function delete($id)
    {
        $data = Prestasi::findOrFail($id);
        $data->delete();

        return back();
    }
}