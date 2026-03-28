@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Lakukan Absensi</h4>
</div>

{{-- SEARCH --}}
<form method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Cari hari / tanggal...">
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
            <th width="180">Tanggal</th>
            <th>Jadwal</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $d)
        <tr>

            {{-- TANGGAL --}}
            <td>
                {{ \Carbon\Carbon::parse($d->absensi->tanggal)->translatedFormat('d F Y') }}
            </td>

            {{-- JADWAL --}}
            <td>
                {{ ucfirst($d->absensi->jadwal->hari) }}
                (
                {{ \Carbon\Carbon::parse($d->absensi->jadwal->jam_mulai)->format('H.i') }}
                -
                {{ \Carbon\Carbon::parse($d->absensi->jadwal->jam_selesai)->format('H.i') }}
                )
            </td>

            {{-- AKSI --}}
            <td>
                <a href="{{ route('atlet.absensi.form', $d->id) }}" 
                   class="btn btn-primary btn-sm">
                    Isi Absensi
                </a>
            </td>

        </tr>

        @empty
        <tr>
            <td colspan="3" class="text-center py-5">
                <div style="font-size:40px;">📭</div>
                <div class="text-muted mt-2">
                    Tidak ada sesi latihan yang sedang dibuka saat ini
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