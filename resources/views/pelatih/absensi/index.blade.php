@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Absensi</h4>
    <a href="{{ route('pelatih.absensi.create') }}" class="btn btn-primary">
        + Buat Absensi
    </a>
</div>

{{-- NOTIF --}}
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

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
    <thead class="table-info text-center">
        <tr>
            <th>Jadwal</th>
            <th width="160">Tanggal</th>
            <th width="200">Rekap</th>
            <th width="120">Status</th>
            <th width="220">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($absensis as $absen)
        <tr>

            {{-- JADWAL --}}
            <td>
                <b>{{ ucfirst($absen->jadwal->hari) }}</b><br>
                <small class="text-muted">
                    {{ \Carbon\Carbon::parse($absen->jadwal->jam_mulai)->format('H.i') }}
                    -
                    {{ \Carbon\Carbon::parse($absen->jadwal->jam_selesai)->format('H.i') }}
                </small>
            </td>

            {{-- TANGGAL --}}
            <td class="text-center">
                {{ \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('d F Y') }}
            </td>

            {{-- REKAP --}}
            <td>
                <span class="badge bg-success">
                    H: {{ $absen->hadir_count }}
                </span>

                <span class="badge bg-warning text-dark">
                    I: {{ $absen->izin_count ?? 0 }}
                </span>

                <span class="badge bg-danger">
                    T: {{ $absen->tidak_hadir_count }}
                </span>
            </td>

            {{-- STATUS --}}
            <td class="text-center">
                @if($absen->status == 'buka')
                    <span class="badge bg-success">Dibuka</span>
                @else
                    <span class="badge bg-danger">Ditutup</span>
                @endif
            </td>

            {{-- AKSI --}}
            <td>

                <a href="{{ route('pelatih.absensi.detail', $absen->id) }}" 
                   class="btn btn-info btn-sm">
                    Detail
                </a>

                {{-- TOGGLE --}}
                <a href="{{ route('pelatih.absensi.toggle', $absen->id) }}" 
                   class="btn btn-warning btn-sm">
                    {{ $absen->status == 'buka' ? 'Tutup' : 'Buka' }}
                </a>

                {{-- DELETE --}}
                <form action="{{ route('pelatih.absensi.delete', $absen->id) }}" 
                      method="POST" 
                      class="d-inline">
                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Yakin hapus absensi ini?')">
                        Hapus
                    </button>
                </form>

            </td>

        </tr>

        @empty
        <tr>
            <td colspan="5" class="text-center py-5">
                <div style="font-size:40px;">📋</div>
                <div class="text-muted mt-2">
                    Belum ada data absensi
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>

</table>

{{-- PAGINATION --}}
<div class="mt-3">
    {{ $absensis->links() }}
</div>

</div>

@endsection