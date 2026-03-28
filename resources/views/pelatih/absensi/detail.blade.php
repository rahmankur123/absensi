@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Detail Absensi</h4>
    <a href="/pelatih/absensi" class="btn btn-secondary">Kembali</a>
</div>

{{-- NOTIF --}}
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="/pelatih/absensi/update/{{ $data->id }}" 
      method="POST" 
      enctype="multipart/form-data">
@csrf

{{-- INFO --}}
<div class="card mb-3 p-3 shadow-sm">
    <div class="row">
        <div class="col-md-6">
            <b>Tanggal:</b><br>
            {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}
        </div>

        <div class="col-md-6">
            <b>Jadwal:</b><br>
            {{ ucfirst($data->jadwal->hari) }} 
            (
            {{ \Carbon\Carbon::parse($data->jadwal->jam_mulai)->format('H.i') }}
            -
            {{ \Carbon\Carbon::parse($data->jadwal->jam_selesai)->format('H.i') }}
            )
        </div>
    </div>

    <div class="mt-3">
        @if($data->status == 'buka')
            <span class="badge bg-success">Absensi Dibuka</span>
        @else
            <span class="badge bg-danger">Absensi Ditutup</span>
        @endif
    </div>
</div>

{{-- SUMMARY --}}
@php
    $hadir = $data->kehadiran->where('status','hadir')->count();
    $izin = $data->kehadiran->where('status','izin')->count();
    $tidak = $data->kehadiran->where('status','tidak_hadir')->count();
@endphp

<div class="row mb-3 text-center">
    <div class="col-md-4">
        <div class="card bg-success text-white p-3">
            <h5>{{ $hadir }}</h5>
            <small>Hadir</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-warning p-3">
            <h5>{{ $izin }}</h5>
            <small>Izin</small>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-danger text-white p-3">
            <h5>{{ $tidak }}</h5>
            <small>Tidak Hadir</small>
        </div>
    </div>
</div>

{{-- FILTER --}}
<div class="mb-3">
    <select id="filterStatus" class="form-control" style="max-width:200px;">
        <option value="all">Semua</option>
        <option value="hadir">Hadir</option>
        <option value="izin">Izin</option>
        <option value="tidak_hadir">Tidak Hadir</option>
    </select>
</div>

{{-- TABEL --}}
<div class="card p-3 shadow-sm">
<table class="table table-bordered table-hover">
    <thead class="table-info text-center">
        <tr>
            <th>Nama Atlet</th>
            <th>Status</th>
            <th>Teknik</th>
            <th>Fisik</th>
            <th>Mental</th>
            <th>Bukti</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data->kehadiran as $k)
        <tr 
            data-status="{{ $k->status }}"
            class="
                @if($k->status=='hadir') table-success
                @elseif($k->status=='izin') table-warning
                @else table-danger
                @endif
            ">

            <td>{{ $k->atlet->user->nama }}</td>

            {{-- STATUS --}}
            <td class="text-center">
                @if($mode == 'edit' && $data->status == 'buka')
                    <select name="status[{{ $k->id }}]" class="form-control">
                        <option value="hadir" {{ $k->status=='hadir'?'selected':'' }}>Hadir</option>
                        <option value="izin" {{ $k->status=='izin'?'selected':'' }}>Izin</option>
                        <option value="tidak_hadir" {{ $k->status=='tidak_hadir'?'selected':'' }}>Tidak Hadir</option>
                    </select>
                @else
                    <span class="badge 
                        @if($k->status=='hadir') bg-success
                        @elseif($k->status=='izin') bg-warning text-dark
                        @else bg-danger
                        @endif">
                        {{ ucfirst(str_replace('_',' ',$k->status)) }}
                    </span>
                @endif
            </td>

            {{-- TEKNIK --}}
            <td>
                @if($k->status == 'hadir' && $mode == 'edit' && $data->status == 'buka')
                    <input type="text" name="evaluasi_teknik[{{ $k->id }}]" 
                           value="{{ $k->evaluasi_teknik }}" class="form-control">
                @elseif($k->status == 'hadir')
                    {{ $k->evaluasi_teknik ?? '-' }}
                @else
                    -
                @endif
            </td>

            {{-- FISIK --}}
            <td>
                @if($k->status == 'hadir' && $mode == 'edit' && $data->status == 'buka')
                    <input type="text" name="evaluasi_fisik[{{ $k->id }}]" 
                           value="{{ $k->evaluasi_fisik }}" class="form-control">
                @elseif($k->status == 'hadir')
                    {{ $k->evaluasi_fisik ?? '-' }}
                @else
                    -
                @endif
            </td>

            {{-- MENTAL --}}
            <td>
                @if($k->status == 'hadir' && $mode == 'edit' && $data->status == 'buka')
                    <input type="text" name="evaluasi_mental[{{ $k->id }}]" 
                           value="{{ $k->evaluasi_mental }}" class="form-control">
                @elseif($k->status == 'hadir')
                    {{ $k->evaluasi_mental ?? '-' }}
                @else
                    -
                @endif
            </td>

            {{-- BUKTI --}}
            <td>
                @if(($k->status == 'hadir' || $k->status == 'izin') && $mode == 'edit' && $data->status == 'buka')
                    <input type="file" name="bukti[{{ $k->id }}]" class="form-control">
                @elseif($k->bukti)
                    <a href="{{ asset('storage/'.$k->bukti) }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        Lihat
                    </a>
                @else
                    -
                @endif
            </td>

        </tr>

        @empty
        <tr>
            <td colspan="6" class="text-center py-5">
                <div style="font-size:40px;">📭</div>
                <div class="text-muted mt-2">
                    Belum ada data kehadiran
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
</div>

{{-- ACTION --}}
<div class="mt-3">

@if($mode == 'view' && $data->status == 'buka')
    <a href="/pelatih/absensi/detail/{{ $data->id }}?mode=edit" 
       class="btn btn-warning">Edit</a>
@endif

@if($mode == 'edit')
    <a href="/pelatih/absensi/detail/{{ $data->id }}" 
       class="btn btn-secondary">Batal</a>

    <button class="btn btn-primary">Update</button>
@endif

@if($data->status == 'buka')
    <a href="/pelatih/absensi/toggle/{{ $data->id }}" 
       class="btn btn-danger">Tutup</a>
@else
    <a href="/pelatih/absensi/toggle/{{ $data->id }}" 
       class="btn btn-success">Buka</a>
@endif

</div>

</form>

{{-- FILTER SCRIPT --}}
<script>
document.getElementById('filterStatus').addEventListener('change', function () {
    let val = this.value;
    let rows = document.querySelectorAll('tbody tr');

    rows.forEach(row => {
        let status = row.getAttribute('data-status');

        if (val === 'all' || status === val) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
});
</script>

@endsection