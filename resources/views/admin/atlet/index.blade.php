@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Atlet</h4>
    <a href="/admin/atlet/create" class="btn btn-primary">+ Tambah Atlet</a>
</div>

{{-- SEARCH --}}
<form method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Cari nama / email...">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Search</button>
        </div>
    </div>
</form>

{{-- TABLE --}}
<div class="card p-3 shadow-sm">

<table class="table table-bordered table-hover">
    <thead class="table-info">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>No HP</th>
            <th>Sabuk</th>
            <th width="200">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $d)
        <tr>
            <td>{{ $d->user->nama }}</td>
            <td>{{ $d->user->email }}</td>
            <td>{{ $d->jenis_kelamin }}</td>
            <td>{{ $d->user->no_hp }}</td>
            <td>
    @if($d->sabuk == 'Putih')
        <span class="badge bg-light text-dark">Putih</span>
    @elseif($d->sabuk == 'Kuning')
        <span class="badge bg-warning">Kuning</span>
    @elseif($d->sabuk == 'Hijau')
        <span class="badge bg-success">Hijau</span>
    @elseif($d->sabuk == 'Biru')
        <span class="badge bg-primary">Biru</span>
    @elseif($d->sabuk == 'Coklat')
        <span class="badge bg-secondary">Coklat</span>
    @elseif($d->sabuk == 'Hitam')
        <span class="badge bg-dark">Hitam</span>
    @else
        -
    @endif
</td>
            <td>

                <a href="/admin/rekap-atlet/{{ $d->id }}" 
                   class="btn btn-info btn-sm">
                    Rekap
                </a>

                <a href="/admin/atlet/edit/{{ $d->id }}" 
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <a href="/admin/atlet/delete/{{ $d->id }}" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin hapus data?')">
                    Hapus
                </a>

            </td>
        </tr>

        @empty
        <tr>
            <td colspan="5" class="text-center text-muted">
                Data atlet tidak ditemukan
            </td>
        </tr>
        @endforelse
    </tbody>

</table>

{{-- PAGINATION --}}
<div class="mt-3">
    {{ $data->links() }}
</div>

</div>

@endsection