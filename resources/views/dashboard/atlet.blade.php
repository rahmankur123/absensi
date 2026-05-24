@extends('layouts.app')

@section('content')

<style>

    .page-title{
        margin-bottom:30px;
    }

    .page-title h3{
        font-weight:700;
        color:#0f172a;
        margin-bottom:4px;
    }

    .page-title p{
        color:#64748b;
        margin:0;
    }

    /* CARD */

    .stat-card{

        position:relative;

        overflow:hidden;

        border:none;

        border-radius:24px;

        padding:24px;

        color:white;

        height:160px;

        transition:0.3s;

        box-shadow:
            0 10px 30px rgba(15,23,42,0.08);
    }

    .stat-card:hover{
        transform:translateY(-4px);
    }

    .stat-card::before{

        content:'';

        position:absolute;

        right:-30px;
        top:-30px;

        width:120px;
        height:120px;

        background:rgba(255,255,255,0.12);

        border-radius:50%;
    }

    .stat-icon{

        width:52px;
        height:52px;

        border-radius:16px;

        display:flex;
        align-items:center;
        justify-content:center;

        background:rgba(255,255,255,0.15);

        font-size:22px;

        margin-bottom:18px;
    }

    .stat-title{
        font-size:14px;
        opacity:0.9;
    }

    .stat-value{
        font-size:34px;
        font-weight:700;
        line-height:1;
        margin-top:8px;
    }

    /* CARD */

    .dashboard-card{

        background:white;

        border:none;

        border-radius:24px;

        padding:24px;

        box-shadow:
            0 4px 20px rgba(15,23,42,0.04);
    }

    .dashboard-card h5{
        font-weight:700;
        color:#0f172a;
        margin-bottom:20px;
    }

    /* PROGRESS */

    .custom-progress{
        height:18px;
        border-radius:20px;
        overflow:hidden;
        background:#e2e8f0;
    }

    .custom-progress-bar{

        height:100%;

        background:
            linear-gradient(
                90deg,
                #10b981,
                #34d399
            );

        border-radius:20px;
    }

    /* TABLE */

    .table{
        border-collapse:separate;
        border-spacing:0 12px;
    }

    .table thead th{
        border:none;
        color:#64748b;
        font-size:13px;
        font-weight:600;
    }

    .table tbody tr{
        background:white;
    }

    .table tbody td{
        padding:18px 16px;
        border:none;
        vertical-align:middle;
        background:white;
    }

    .table tbody tr td:first-child{
        border-radius:14px 0 0 14px;
    }

    .table tbody tr td:last-child{
        border-radius:0 14px 14px 0;
    }

    .status-badge{

        padding:8px 14px;

        border-radius:12px;

        font-size:12px;
        font-weight:600;

        display:inline-flex;
        align-items:center;
    }

    .hadir{
        background:#dcfce7;
        color:#166534;
    }

    .izin{
        background:#fef3c7;
        color:#92400e;
    }

    .alpha{
        background:#fee2e2;
        color:#991b1b;
    }

</style>

@php
$total = $totalLatihan;
$persen = $total ? ($hadir / $total) * 100 : 0;
@endphp

<!-- TITLE -->
<div class="page-title">

    <h3>
        Selamat Datang, {{ Auth::user()->nama }}
    </h3>

    <p>
        Monitor perkembangan latihan dan kehadiran anda
    </p>

</div>

<!-- STATISTIC -->
<div class="row g-4 mb-4">

    <div class="col-md-3">

        <div class="stat-card"
             style="background:linear-gradient(135deg,#3b82f6,#60a5fa)">

            <div class="stat-icon">
                🏋️
            </div>

            <div class="stat-title">
                Total Latihan
            </div>

            <div class="stat-value">
                {{ $totalLatihan }}
            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="stat-card"
             style="background:linear-gradient(135deg,#10b981,#34d399)">

            <div class="stat-icon">
                ✅
            </div>

            <div class="stat-title">
                Hadir
            </div>

            <div class="stat-value">
                {{ $hadir }}
            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="stat-card"
             style="background:linear-gradient(135deg,#f59e0b,#fbbf24)">

            <div class="stat-icon">
                📌
            </div>

            <div class="stat-title">
                Izin
            </div>

            <div class="stat-value">
                {{ $izin }}
            </div>

        </div>

    </div>

    <div class="col-md-3">

        <div class="stat-card"
             style="background:linear-gradient(135deg,#ef4444,#f87171)">

            <div class="stat-icon">
                🏆
            </div>

            <div class="stat-title">
                Prestasi
            </div>

            <div class="stat-value">
                {{ $prestasi }}
            </div>

        </div>

    </div>

</div>

<!-- PROGRESS -->
<div class="dashboard-card mb-4">

    <h5>
        Progress Kehadiran
    </h5>

    <div class="custom-progress mb-3">

        <div class="custom-progress-bar"
             style="width:{{ $persen }}%">

        </div>

    </div>

    <div class="d-flex justify-content-between">

        <small class="text-muted">
            {{ $hadir }} hadir
        </small>

        <small class="text-muted">
            {{ round($persen) }}%
        </small>

    </div>

</div>

<!-- RIWAYAT -->
<div class="dashboard-card">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <div>

            <h5 class="mb-1">
                Latihan Terakhir
            </h5>

            <small class="text-muted">
                Riwayat kehadiran latihan terbaru
            </small>

        </div>

    </div>

    <table class="table align-middle">

        <thead>

            <tr>

                <th>Tanggal</th>
                <th>Jadwal</th>
                <th>Status</th>

            </tr>

        </thead>

        <tbody>

        @forelse($recent as $r)

            <tr>

                <td>

                    {{ $r->absensi 
                        ? \Carbon\Carbon::parse($r->absensi->tanggal)->translatedFormat('d F Y') 
                        : '-' }}

                </td>

                <td>

                    
                <div class="">
                    {{ $r->absensi && $r->absensi->jadwal ? ucfirst($r->absensi->jadwal->hari) : '-' }}

                    @if($r->absensi && $r->absensi->jadwal)

                        <br>

                        <small class="text-muted">
                            {{ $r->absensi->jadwal->jam_mulai }} - {{ $r->absensi->jadwal->jam_selesai }}
                        </small>
                    @endif
                </div>

                <td>

                    @if($r->status == 'hadir')

                        <span class="status-badge hadir">
                            Hadir
                        </span>

                    @elseif($r->status == 'izin')

                        <span class="status-badge izin">
                            Izin
                        </span>

                    @else

                        <span class="status-badge alpha">
                            Tidak Hadir
                        </span>

                    @endif

                </td>

            </tr>

        @empty

            <tr>

                <td colspan="2"
                    class="text-center text-muted py-4">

                    Belum ada riwayat latihan

                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection