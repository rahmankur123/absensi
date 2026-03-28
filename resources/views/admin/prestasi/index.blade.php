@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Validasi Prestasi Atlet</h4>
</div>

{{-- SEARCH --}}
<form method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input type="text" name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Cari atlet / kejuaraan...">
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
            <th>Atlet</th>
            <th>Kejuaraan</th>
            <th>Tingkat</th>
            <th>Juara</th>
            <th>Tahun</th>
            <th>Bukti</th>
            <th>Status</th>
            <th width="180">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $d)
        <tr>
            <td>{{ $d->atlet->user->nama ?? '-' }}</td>
            <td>{{ $d->nama_kejuaraan }}</td>
            <td>{{ ucfirst($d->tingkat) }}</td>
            <td>{{ $d->juara }}</td>
            <td>{{ $d->tahun }}</td>

            {{-- BUKTI --}}
            <td>
                @if($d->bukti_prestasi)
                    <a href="{{ asset('storage/'.$d->bukti_prestasi) }}" 
                       target="_blank" 
                       class="btn btn-sm btn-info">
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
                @if($d->status == 'pending')
                    <a href="/admin/prestasi/approve/{{ $d->id }}" 
                       class="btn btn-success btn-sm"
                       onclick="return confirm('Setujui prestasi ini?')">
                        Approve
                    </a>

                    <a href="/admin/prestasi/reject/{{ $d->id }}" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Tolak prestasi ini?')">
                        Reject
                    </a>
                @else
                    <span class="text-muted">Selesai</span>
                @endif
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="8" class="text-center text-muted">
                Data prestasi tidak ditemukan
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