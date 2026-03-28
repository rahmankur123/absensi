@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Rekap Atlet</h4>
</div>

{{-- INFO ATLET --}}
<div class="card p-3 mb-3 shadow-sm">
    <b>Nama:</b> {{ $atlet->user->nama }}
</div>

{{-- FILTER --}}
<form method="GET" class="mb-3">
    <div class="card p-3 shadow-sm">
        <div class="row align-items-end">

            {{-- BULAN --}}
            <div class="col-md-3">
                <label>Bulan</label>
                <select name="bulan" class="form-control">
                    @foreach([
                        '01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April',
                        '05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus',
                        '09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember'
                    ] as $key => $val)
                        <option value="{{ $key }}" 
                            {{ request('bulan') == $key ? 'selected' : '' }}>
                            {{ $val }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- TAHUN --}}
            <div class="col-md-3">
                <label>Tahun</label>
                <select name="tahun" class="form-control">
                    @for($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}" 
                            {{ request('tahun') == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>

            {{-- FILTER --}}
            <div class="col-md-2">
                <button class="btn btn-primary w-100">Filter</button>
            </div>

            {{-- PDF --}}
            <div class="col-md-2">
                <a href="/laporan/rekap/cetak/{{ $atlet->id }}?bulan={{ request('bulan') }}&tahun={{ request('tahun') }}" 
                   class="btn btn-danger w-100">
                    Cetak PDF
                </a>
            </div>

        </div>
    </div>
</form>

{{-- SUMMARY --}}
@php
$hadir = $data->where('status','hadir')->count();
$izin = $data->where('status','izin')->count();
$tidak = $data->where('status','tidak_hadir')->count();
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

{{-- TABEL --}}
<div class="card p-3 shadow-sm">

<table class="table table-bordered table-hover">

    <thead class="table-info text-center">
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

    @forelse($data as $d)
        <tr class="
            @if($d->status=='hadir') table-success
            @elseif($d->status=='izin') table-warning
            @else table-danger
            @endif
        ">

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

            {{-- STATUS --}}
            <td class="text-center">
                <span class="badge
                    @if($d->status=='hadir') bg-success
                    @elseif($d->status=='izin') bg-warning text-dark
                    @else bg-danger
                    @endif">
                    {{ ucfirst(str_replace('_',' ',$d->status)) }}
                </span>
            </td>

            {{-- EVALUASI --}}
            <td>{{ $d->status == 'hadir' ? ($d->evaluasi_teknik ?? '-') : '-' }}</td>
            <td>{{ $d->status == 'hadir' ? ($d->evaluasi_fisik ?? '-') : '-' }}</td>
            <td>{{ $d->status == 'hadir' ? ($d->evaluasi_mental ?? '-') : '-' }}</td>

        </tr>

    @empty
        <tr>
            <td colspan="6" class="text-center py-5">
                <div style="font-size:40px;">📊</div>
                <div class="text-muted mt-2">
                    Belum ada data latihan pada periode ini
                </div>
            </td>
        </tr>
    @endforelse

    </tbody>

</table>

</div>

@endsection