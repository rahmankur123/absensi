@extends('layouts.app')

@section('content')

<h4 class="mb-4">Detail Atlet</h4>

<div class="card p-4">

<div class="text-center mb-4">
    <img src="{{ $data->user->foto ? asset('storage/'.$data->user->foto) : 'https://via.placeholder.com/150' }}"
         class="rounded-circle"
         width="120">
</div>

<div class="row">

    <div class="col-md-6 mb-2">
        <b>Nama:</b> {{ $data->user->nama }}
    </div>

    <div class="col-md-6 mb-2">
        <b>Email:</b> {{ $data->user->email }}
    </div>

    <div class="col-md-6 mb-2">
        <b>No HP:</b> {{ $data->user->no_hp }}
    </div>

    <div class="col-md-6 mb-2">
        <b>Jenis Kelamin:</b> {{ $data->jenis_kelamin }}
    </div>

    <div class="col-md-6 mb-2">
        <b>Tanggal Lahir:</b> {{ $data->tanggal_lahir }}
    </div>

    <div class="col-md-6 mb-2">
        <b>Berat:</b> {{ $data->berat_badan }} kg
    </div>

    <div class="col-md-6 mb-2">
        <b>Tinggi:</b> {{ $data->tinggi_badan }} cm
    </div>

    <div class="col-md-12 mb-2">
        <b>Alamat:</b> {{ $data->alamat }}
    </div>

</div>

</div>

{{-- RIWAYAT LATIHAN --}}
<h5 class="mt-4">Riwayat Latihan</h5>

<div class="card p-3">
<table class="table table-bordered">

    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Jadwal</th>
            <th>Status</th>
            <th>Teknik</th>
            <th>Fisik</th>
            <th>Mental</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data->kehadiran as $k)
        <tr>
            <td>{{ $k->absensi->tanggal }}</td>
            <td>{{ $k->absensi->jadwal->hari }}</td>
            <td>{{ $k->status }}</td>
            <td>{{ $k->evaluasi_teknik ?? '-' }}</td>
            <td>{{ $k->evaluasi_fisik ?? '-' }}</td>
            <td>{{ $k->evaluasi_mental ?? '-' }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center text-muted">
                Belum ada riwayat latihan
            </td>
        </tr>
        @endforelse
    </tbody>

</table>
</div>

<a href="/pelatih/atlet" class="btn btn-secondary mt-3">Kembali</a>

@endsection