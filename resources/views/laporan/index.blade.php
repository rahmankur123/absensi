@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-1">Laporan Kehadiran</h4>
        <small class="text-muted">
            Bulan 
            {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }} 
            {{ $tahun }}
        </small>
    </div>
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
                            {{ $bulan == $key ? 'selected' : '' }}>
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
                            {{ $tahun == $i ? 'selected' : '' }}>
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
                <a href="/laporan/cetak/{{ $bulan }}/{{ $tahun }}" 
                   class="btn btn-danger w-100">
                    Download PDF
                </a>
            </div>

        </div>
    </div>
</form>

{{-- TABLE --}}
<div class="card p-3 shadow-sm">

<table class="table table-bordered table-hover">

    <thead class="table-info text-center">
        <tr>
            <th>Tanggal</th>
            <th>Jadwal</th>
            <th>Hadir</th>
            <th>Izin</th>
            <th>Tidak Hadir</th>
        </tr>
    </thead>

    <tbody>

    @forelse($data as $item)

        @php
            $hadir = $item->kehadiran->where('status','hadir')->count();
            $izin = $item->kehadiran->where('status','izin')->count();
            $tidak = $item->kehadiran->where('status','tidak_hadir')->count();
        @endphp

        <tr>

            {{-- TANGGAL --}}
            <td>
                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
            </td>

            {{-- JADWAL --}}
            <td>
                {{ ucfirst($item->jadwal->hari) }} 
                (
                {{ \Carbon\Carbon::parse($item->jadwal->jam_mulai)->format('H.i') }}
                -
                {{ \Carbon\Carbon::parse($item->jadwal->jam_selesai)->format('H.i') }}
                )
            </td>

            {{-- HADIR --}}
            <td class="text-center">
                <span class="badge bg-success">{{ $hadir }}</span>
            </td>

            {{-- IZIN --}}
            <td class="text-center">
                <span class="badge bg-warning text-dark">{{ $izin }}</span>
            </td>

            {{-- TIDAK HADIR --}}
            <td class="text-center">
                <span class="badge bg-danger">{{ $tidak }}</span>
            </td>

        </tr>

    @empty

        <tr>
            <td colspan="5" class="text-center py-5">
                <div style="font-size:40px;">📅</div>
                <div class="text-muted mt-2">
                    Belum ada sesi latihan pada bulan ini
                </div>
            </td>
        </tr>

    @endforelse

    </tbody>

</table>

</div>

@endsection