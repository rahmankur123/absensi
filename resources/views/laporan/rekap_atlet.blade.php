@extends('layouts.app')

@section('content')

<style>

    a{
        text-decoration:none !important;
    }

    .page-header{
        margin-bottom:28px;
    }

    .page-header h3{
        font-weight:700;
        color:#0f172a;
        margin-bottom:4px;
    }

    .page-header p{
        margin:0;
        color:#64748b;
        font-size:14px;
    }

    /* CARD */

    .custom-card{

        background:white;

        border:none;

        border-radius:28px;

        padding:28px;

        box-shadow:
            0 10px 35px rgba(15,23,42,0.05);
    }

    /* ATHLETE */

    .athlete-info{

        display:flex;
        align-items:center;

        gap:16px;
    }

    .athlete-avatar{

        width:58px;
        height:58px;

        border-radius:20px;

        object-fit:cover;

        box-shadow:
            0 10px 20px rgba(15,23,42,0.08);
    }

    .athlete-name{

        font-size:18px;
        font-weight:700;

        color:#0f172a;
    }

    .athlete-label{

        font-size:13px;
        color:#64748b;
    }

    /* FILTER */

    .form-label{

        font-size:13px;
        font-weight:600;

        color:#475569;

        margin-bottom:8px;
    }

    .form-control,
    .form-select{

        height:52px;

        border:none;

        border-radius:16px;

        background:#f8fafc;

        padding:0 18px;

        transition:0.2s;
    }

    .form-control:focus,
    .form-select:focus{

        background:white;

        border:none;

        box-shadow:
            0 0 0 4px rgba(14,165,233,0.12);
    }

    /* BUTTON */

    .btn-filter,
    .btn-pdf{

        height:52px;

        border:none;

        border-radius:16px;

        font-weight:600;

        transition:0.2s;
    }

    .btn-filter{

        background:
            linear-gradient(
                135deg,
                #0ea5e9,
                #6366f1
            );

        color:white;
    }

    .btn-pdf{

        background:#ef4444;

        color:white;
    }

    .btn-filter:hover,
    .btn-pdf:hover{

        transform:translateY(-2px);

        color:white;
    }

    /* SUMMARY */

    .summary-card{

        border:none;

        border-radius:24px;

        padding:24px;

        color:white;

        position:relative;

        overflow:hidden;
    }

    .summary-card::before{

        content:'';

        position:absolute;

        right:-25px;
        top:-25px;

        width:110px;
        height:110px;

        border-radius:50%;

        background:rgba(255,255,255,0.10);
    }

    .summary-title{

        font-size:14px;

        opacity:0.9;
    }

    .summary-value{

        font-size:34px;

        font-weight:700;

        line-height:1;

        margin-top:10px;
    }

    /* TABLE */

    .table{
        border-collapse:separate;
        border-spacing:0 14px;
    }

    .table thead th{

        border:none;

        color:#64748b;

        font-size:13px;
        font-weight:600;

        padding:0 16px 10px;
    }

    .table tbody td{

        background:white;

        padding:18px 16px;

        border:none;

        vertical-align:middle;
    }

    .table tbody tr td:first-child{
        border-radius:18px 0 0 18px;
    }

    .table tbody tr td:last-child{
        border-radius:0 18px 18px 0;
    }

    /* STATUS */

    .status-badge{

        padding:8px 14px;

        border-radius:12px;

        font-size:12px;
        font-weight:600;

        display:inline-block;
    }

    .hadir{
        background:#dcfce7;
        color:#166534;
    }

    .izin{
        background:#fef3c7;
        color:#92400e;
    }

    .tidak{
        background:#fee2e2;
        color:#991b1b;
    }

    /* SCORE */

    .score-box{

        min-width:50px;

        padding:8px 12px;

        border-radius:12px;

        background:#eff6ff;

        color:#2563eb;

        font-weight:600;

        text-align:center;

        display:inline-block;
    }

    /* EMPTY */

    .empty-state{

        text-align:center;

        padding:60px 20px;
    }

    .empty-icon{
        font-size:48px;
        margin-bottom:12px;
    }

    .empty-text{
        color:#64748b;
    }

</style>


@php

$hadir = $data->where('status','hadir')->count();
$izin = $data->where('status','izin')->count();
$tidak = $data->where('status','tidak_hadir')->count();

@endphp


<!-- HEADER -->
<div class="page-header">

    <h3>
        Rekap Atlet
    </h3>

    <p>
        Monitoring aktivitas dan evaluasi latihan atlet
    </p>

</div>


<!-- ATHLETE -->
<div class="custom-card mb-4">

    <div class="athlete-info">

        <img src="{{ $atlet->user->foto ? asset('storage/'.$atlet->user->foto) : 'https://via.placeholder.com/150' }}"
             class="athlete-avatar">

        <div>

            <div class="athlete-label">
                Data Atlet
            </div>

            <div class="athlete-name">

                {{ $atlet->user->nama }}

            </div>

        </div>

    </div>

</div>


<!-- FILTER -->
<form method="GET" class="mb-4">

    <div class="custom-card">

        <div class="row g-3 align-items-end">

            <!-- BULAN -->
            <div class="col-md-3">

                <label class="form-label">
                    Bulan
                </label>

                <select name="bulan"
                        class="form-select">

                    @foreach([
                        '01'=>'Januari',
                        '02'=>'Februari',
                        '03'=>'Maret',
                        '04'=>'April',
                        '05'=>'Mei',
                        '06'=>'Juni',
                        '07'=>'Juli',
                        '08'=>'Agustus',
                        '09'=>'September',
                        '10'=>'Oktober',
                        '11'=>'November',
                        '12'=>'Desember'
                    ] as $key => $val)

                    <option value="{{ $key }}"
                        {{ request('bulan') == $key ? 'selected' : '' }}>

                        {{ $val }}

                    </option>

                    @endforeach

                </select>

            </div>


            <!-- TAHUN -->
            <div class="col-md-3">

                <label class="form-label">
                    Tahun
                </label>

                <select name="tahun"
                        class="form-select">

                    @for($i = date('Y'); $i >= 2020; $i--)

                    <option value="{{ $i }}"
                        {{ request('tahun') == $i ? 'selected' : '' }}>

                        {{ $i }}

                    </option>

                    @endfor

                </select>

            </div>


            <!-- BUTTON -->
            <div class="col-md-2">

                <button class="btn-filter w-100">

                    Filter

                </button>

            </div>


            <!-- PDF -->
            <div class="col-md-2">

                <a href="/laporan/rekap/cetak/{{ $atlet->id }}?bulan={{ request('bulan') }}&tahun={{ request('tahun') }}"
                   class="btn btn-pdf w-100 d-flex align-items-center justify-content-center gap-2">

                    Cetak PDF

                </a>

            </div>

        </div>

    </div>

</form>


<!-- SUMMARY -->
<div class="row g-4 mb-4">

    <div class="col-md-4">

        <div class="summary-card"
             style="background:linear-gradient(135deg,#10b981,#34d399)">

            <div class="summary-title">
                Hadir
            </div>

            <div class="summary-value">
                {{ $hadir }}
            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="summary-card"
             style="background:linear-gradient(135deg,#f59e0b,#fbbf24)">

            <div class="summary-title">
                Izin
            </div>

            <div class="summary-value">
                {{ $izin }}
            </div>

        </div>

    </div>


    <div class="col-md-4">

        <div class="summary-card"
             style="background:linear-gradient(135deg,#ef4444,#f87171)">

            <div class="summary-title">
                Tidak Hadir
            </div>

            <div class="summary-value">
                {{ $tidak }}
            </div>

        </div>

    </div>

</div>


<!-- TABLE -->
<div class="custom-card">

    <div class="table-responsive">

        <table class="table align-middle">

            <thead>

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

                <tr>

                    <!-- TANGGAL -->
                    <td>

                        {{ \Carbon\Carbon::parse($d->absensi->tanggal)->translatedFormat('d F Y') }}

                    </td>


                    <!-- JADWAL -->
                    <td>

                        {{ ucfirst($d->absensi->jadwal->hari) }}

                        <br>

                        <small class="text-muted">

                            {{ \Carbon\Carbon::parse($d->absensi->jadwal->jam_mulai)->format('H.i') }}
                            -
                            {{ \Carbon\Carbon::parse($d->absensi->jadwal->jam_selesai)->format('H.i') }}

                        </small>

                    </td>


                    <!-- STATUS -->
                    <td>

                        <span class="status-badge
                        
                            @if($d->status=='hadir')
                                hadir
                            @elseif($d->status=='izin')
                                izin
                            @else
                                tidak
                            @endif
                        
                        ">

                            {{ ucfirst(str_replace('_',' ',$d->status)) }}

                        </span>

                    </td>


                    <!-- TEKNIK -->
                    <td>

                        <span class="score-box">

                            {{ $d->status == 'hadir'
                                ? ($d->evaluasi_teknik ?? '-')
                                : '-' }}

                        </span>

                    </td>


                    <!-- FISIK -->
                    <td>

                        <span class="score-box">

                            {{ $d->status == 'hadir'
                                ? ($d->evaluasi_fisik ?? '-')
                                : '-' }}

                        </span>

                    </td>


                    <!-- MENTAL -->
                    <td>

                        <span class="score-box">

                            {{ $d->status == 'hadir'
                                ? ($d->evaluasi_mental ?? '-')
                                : '-' }}

                        </span>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6">

                        <div class="empty-state">

                            <div class="empty-icon">
                                📊
                            </div>

                            <div class="empty-text">

                                Belum ada data latihan pada periode ini

                            </div>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection