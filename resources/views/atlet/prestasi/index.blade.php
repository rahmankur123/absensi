@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Prestasi Saya</h4>
    <a href="/atlet/prestasi/create" class="btn btn-primary">+ Tambah</a>
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
                   placeholder="Cari kejuaraan...">
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
            <th>Kejuaraan</th>
            <th>Tingkat</th>
            <th>Juara</th>
            <th>Tahun</th>
            <th>Bukti</th>
            <th>Status</th>
            <th width="120">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $d)
        <tr>
            <td>{{ $d->nama_kejuaraan }}</td>
            <td>{{ ucfirst($d->tingkat) }}</td>
            <td>{{ $d->juara }}</td>
            <td>{{ $d->tahun }}</td>

            {{-- BUKTI --}}
            <td>
                @if($d->bukti_prestasi)
                    <a href="{{ asset('storage/'.$d->bukti_prestasi) }}" 
                       target="_blank"
                       class="btn btn-info btn-sm">
                        Lihat
                    </a>
                @else
                    <span class="text-muted">Tidak ada</span>
                @endif
            </td>

            {{-- STATUS --}}
            <td>
                @if($d->status == 'pending')
                    <span class="badge bg-secondary">Pending</span>
                @elseif($d->status == 'disetujui')
                    <span class="badge bg-success">Disetujui</span>
                @else
                    <span class="badge bg-danger">Ditolak</span>
                @endif
            </td>

            {{-- AKSI --}}
            <td>
                <a href="/atlet/prestasi/delete/{{ $d->id }}" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Yakin hapus prestasi ini?')">
                    Hapus
                </a>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="7" class="text-center text-muted">
                Belum ada data prestasi
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