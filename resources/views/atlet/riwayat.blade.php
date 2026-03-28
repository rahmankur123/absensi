@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Riwayat Absensi Saya</h4>
</div>

{{-- SEARCH --}}
<form method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Cari tanggal / hari...">
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Search</button>
        </div>
    </div>
</form>

{{-- TABLE --}}
<div class="card p-3 shadow-sm">

<table class="table table-bordered table-hover">
    <thead class="table-info text-center">
        <tr>
            <th width="160">Tanggal</th>
            <th>Jadwal</th>
            <th width="140">Status</th>
            <th>Evaluasi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $d)
        <tr>

            {{-- TANGGAL --}}
            <td class="text-center">
                {{ \Carbon\Carbon::parse($d->absensi->tanggal)->translatedFormat('d F Y') }}
            </td>

            {{-- JADWAL --}}
            <td>
                <b>{{ ucfirst($d->absensi->jadwal->hari) }}</b><br>
                <small class="text-muted">
                    {{ \Carbon\Carbon::parse($d->absensi->jadwal->jam_mulai)->format('H.i') }}
                    -
                    {{ \Carbon\Carbon::parse($d->absensi->jadwal->jam_selesai)->format('H.i') }}
                </small>
            </td>

            {{-- STATUS --}}
            <td class="text-center">
                @if($d->status == 'hadir')
                    <span class="badge bg-success">Hadir</span>
                @elseif($d->status == 'izin')
                    <span class="badge bg-warning text-dark">Izin</span>
                @else
                    <span class="badge bg-danger">Tidak Hadir</span>
                @endif
            </td>

            {{-- EVALUASI --}}
            <td>
                <div class="p-2 border rounded bg-light">
                    <div><b>Teknik:</b> {{ $d->evaluasi_teknik ?? '-' }}</div>
                    <div><b>Fisik:</b> {{ $d->evaluasi_fisik ?? '-' }}</div>
                    <div><b>Mental:</b> {{ $d->evaluasi_mental ?? '-' }}</div>
                </div>
            </td>

        </tr>

        @empty
        <tr>
            <td colspan="4" class="text-center py-5">
                <div style="font-size:40px;">📋</div>
                <div class="text-muted mt-2">
                    Belum ada riwayat absensi
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