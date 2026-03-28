@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Jadwal Latihan</h4>
    <a href="/admin/jadwal/create" class="btn btn-primary">+ Tambah Jadwal</a>
</div>

{{-- SEARCH --}}
<form method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Cari hari (senin, selasa...)">
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
            <th width="50">No</th>
            <th>Hari</th>
            <th>Jam</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $i => $d)
        <tr>
            <td>
                {{ ($data->currentPage() - 1) * $data->perPage() + $i + 1 }}
            </td>

            <td>{{ ucfirst($d->hari) }}</td>

            <td>
                {{ \Carbon\Carbon::parse($d->jam_mulai)->format('H.i') }}
                -
                {{ \Carbon\Carbon::parse($d->jam_selesai)->format('H.i') }}
            </td>

            <td>

                <a href="/admin/jadwal/edit/{{ $d->id }}" 
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <a href="/admin/jadwal/delete/{{ $d->id }}" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin hapus jadwal ini?')">
                    Hapus
                </a>

            </td>
        </tr>

        @empty
        <tr>
            <td colspan="4" class="text-center text-muted">
                Data jadwal tidak ditemukan
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