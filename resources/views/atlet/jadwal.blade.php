@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Jadwal Latihan</h4>
</div>

{{-- SEARCH --}}
<form method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Cari hari...">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Search</button>
        </div>
    </div>
</form>

{{-- TABLE --}}
<div class="card p-3 shadow-sm">

<table class="table table-bordered table-hover text-center">
    <thead class="table-info">
        <tr>
            <th width="200">Hari</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $d)
        <tr>
            <td class="fw-bold">{{ ucfirst($d->hari) }}</td>

            <td>
                {{ \Carbon\Carbon::parse($d->jam_mulai)->format('H.i') }}
            </td>

            <td>
                {{ \Carbon\Carbon::parse($d->jam_selesai)->format('H.i') }}
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="3" class="text-center py-5">
                <div style="font-size:40px;">📅</div>
                <div class="text-muted mt-2">
                    Belum ada jadwal latihan tersedia
                </div>
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