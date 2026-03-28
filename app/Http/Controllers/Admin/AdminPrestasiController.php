<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prestasi;

class AdminPrestasiController extends Controller
{
    public function index(Request $request)
{
    $query = Prestasi::with('atlet.user');

    if ($request->search) {
        $query->where('nama_kejuaraan', 'like', '%'.$request->search.'%')
              ->orWhereHas('atlet.user', function($q) use ($request){
                  $q->where('nama', 'like', '%'.$request->search.'%');
              });
    }

    $data = $query->latest()->paginate(10);

    return view('admin.prestasi.index', compact('data'));
}

    public function approve($id)
    {
        $data = Prestasi::findOrFail($id);
        $data->update(['status' => 'disetujui']);

        return back();
    }

    public function reject($id)
    {
        $data = Prestasi::findOrFail($id);
        $data->update(['status' => 'ditolak']);

        return back();
    }
}