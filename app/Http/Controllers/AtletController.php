<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Atlet;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AtletController extends Controller
{
    public function index(Request $request)
{
    $query = Atlet::with('user');

    if ($request->search) {
        $query->whereHas('user', function($q) use ($request){
            $q->where('nama', 'like', '%'.$request->search.'%')
              ->orWhere('email', 'like', '%'.$request->search.'%');
        });
    }

    $data = $query->latest()->paginate(10);

    return view('admin.atlet.index', compact('data'));
}
public function indexpelatih(Request $request)
{
    $query = Atlet::with('user');

    if ($request->search) {
        $query->whereHas('user', function ($q) use ($request) {
            $q->where('nama', 'like', '%'.$request->search.'%')
              ->orWhere('email', 'like', '%'.$request->search.'%');
        });
    }

    $data = $query->paginate(10);

    return view('pelatih.atlet.index', compact('data'));
}
public function create()
{
    return view('admin.atlet.create');
}
public function store(Request $request)
{
    $data = $request->validate([
        'nama' => 'required',
        'email' => 'required|email|unique:users,email',
        'jenis_kelamin' => 'required',
        'no_hp' => 'required',
        'password' => 'required|min:6|confirmed',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required',
        'berat_badan' => 'required|numeric',
        'tinggi_badan' => 'required|numeric',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // upload foto
    $pathFoto = null;
    if ($request->hasFile('foto')) {
        $pathFoto = $request->file('foto')->store('foto_atlet', 'public');
    }

    // simpan user
    $user = User::create([
        'nama' => $data['nama'],
        'email' => $data['email'],
        'password' => bcrypt($data['password']),
        'role' => 'atlet',
        'no_hp' => $data['no_hp'],
        'foto' => $pathFoto
    ]);

    // simpan atlet
    Atlet::create([
        'user_id' => $user->id,
        'tanggal_lahir' => $data['tanggal_lahir'],
        'alamat' => $data['alamat'],
        'berat_badan' => $data['berat_badan'],
        'tinggi_badan' => $data['tinggi_badan'],
        'jenis_kelamin' => $data['jenis_kelamin']
    ]);

    return redirect('/admin/atlet');
}
public function edit($id)
{
    $data = \App\Models\Atlet::with('user')->find($id);
    return view('admin.atlet.edit', compact('data'));
}
public function detailpelatih($id)
{
    $data = Atlet::with('user', 'kehadiran.absensi.jadwal')->find($id);
    return view('pelatih.atlet.detail', compact('data'));
}
public function update(Request $request, $id)
{
    $atlet = Atlet::findOrFail($id);
    $user = User::findOrFail($atlet->user_id);

    $data = $request->validate([
        'nama' => 'required',
        'email' => 'required|email',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required',
        'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // upload foto baru
    if ($request->hasFile('foto')) {
        $pathFoto = $request->file('foto')->store('foto_user', 'public');
        $user->foto = $pathFoto;
    }

    $user->update([
        'nama' => $data['nama'],
        'email' => $data['email'],
        'foto' => $user->foto
    ]);

    $atlet->update([
        'tanggal_lahir' => $data['tanggal_lahir'],
        'alamat' => $data['alamat']
    ]);

    return redirect('/admin/atlet');
}
public function delete($id)
{
    $atlet = Atlet::find($id);
    $user = User::find($atlet->user_id);
    $user->delete();
    $atlet->delete();

    return redirect('/admin/atlet');
}}
