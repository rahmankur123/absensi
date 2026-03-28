<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
{
    $query = Jadwal::query();

    if ($request->search) {
        $query->where('hari', 'like', '%'.$request->search.'%');
    }

    $data = $query->latest()->paginate(10);

    return view('admin.jadwal.index', compact('data'));
}

    public function create()
    {
        return view('admin.jadwal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai'
        ]);

        Jadwal::create($request->all());

        return redirect('/admin/jadwal');
    }

    public function edit($id)
    {
        $data = Jadwal::findOrFail($id);
        return view('admin.jadwal.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required|after:jam_mulai'

        ]);

        $data = Jadwal::findOrFail($id);
        $data->update($request->all());

        return redirect('/admin/jadwal');
    }

    public function delete($id)
    {
        Jadwal::findOrFail($id)->delete();
        return redirect('/admin/jadwal');
    }
}