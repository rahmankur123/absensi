@extends('layouts.app')

@section('content')

<style>

    a{
        text-decoration:none !important;
    }

    .page-header{

        display:flex;
        justify-content:space-between;
        align-items:center;

        margin-bottom:28px;
    }

    .page-title h3{

        font-weight:700;

        color:#0f172a;

        margin-bottom:4px;
    }

    .page-title p{

        color:#64748b;

        margin:0;

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

    /* FILTER */

    .filter-label{

        font-size:14px;

        font-weight:600;

        color:#334155;

        margin-bottom:10px;
    }

    .custom-input{

        height:54px;

        border:none;

        border-radius:18px;

        background:#f8fafc;

        padding:0 18px;

        transition:0.2s;
    }

    .custom-input:focus{

        outline:none;

        background:white;

        box-shadow:
            0 0 0 4px rgba(14,165,233,0.10);
    }

    select.custom-input{

        appearance:none;

        background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='gray' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.646 5.646a.5.5 0 0 1 .708 0L8 11.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");

        background-repeat:no-repeat;

        background-position:right 16px center;

        padding-right:45px;
    }

    /* BUTTON */

    .btn-filter{

        height:54px;

        border:none;

        border-radius:18px;

        background:#0f172a;

        color:white;

        font-weight:600;

        transition:0.3s;
    }

    .btn-filter:hover{

        transform:translateY(-2px);

        color:white;
    }

    .btn-pdf{

        height:54px;

        border:none;

        border-radius:18px;

        background:
            linear-gradient(
                135deg,
                #ef4444,
                #f87171
            );

        color:white;

        font-weight:600;

        display:flex;
        align-items:center;
        justify-content:center;

        transition:0.3s;
    }

    .btn-pdf:hover{

        transform:translateY(-2px);

        color:white;
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

    /* JADWAL */

    .jadwal-day{

        font-weight:700;

        color:#0f172a;

        margin-bottom:4px;
    }

    .jadwal-time{

        color:#64748b;

        font-size:13px;
    }

    /* BADGE */

    .badge-custom{

        display:inline-flex;

        align-items:center;
        justify-content:center;

        min-width:46px;

        padding:8px 14px;

        border-radius:12px;

        font-size:13px;
        font-weight:700;
    }

    .badge-hadir{
        background:#dcfce7;
        color:#166534;
    }

    .badge-izin{
        background:#fef3c7;
        color:#92400e;
    }

    .badge-tidak{
        background:#fee2e2;
        color:#991b1b;
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


<!-- HEADER -->
<div class="page-header">

    <div class="page-title">

        <h3>
            Laporan Kehadiran
        </h3>

        <p>

            Bulan

            {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}

            {{ $tahun }}

        </p>

    </div>

</div>


<!-- FILTER -->
<form method="GET" class="mb-4">

    <div class="custom-card">

        <div class="row g-4 align-items-end">

            <!-- BULAN -->
            <div class="col-md-3">

                <label class="filter-label">

                    Bulan

                </label>

                <select name="bulan"
                        class="custom-input w-100">

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


            <!-- TAHUN -->
            <div class="col-md-3">

                <label class="filter-label">

                    Tahun

                </label>

                <select name="tahun"
                        class="custom-input w-100">

                    @for($i = date('Y'); $i >= 2020; $i--)

                        <option value="{{ $i }}"
                            {{ $tahun == $i ? 'selected' : '' }}>

                            {{ $i }}

                        </option>

                    @endfor

                </select>

            </div>


            <!-- FILTER -->
            <div class="col-md-2">

                <button class="btn-filter w-100">

                    Filter

                </button>

            </div>


            <!-- PDF -->
            <div class="col-md-2">

                <a href="/laporan/cetak/{{ $bulan }}/{{ $tahun }}"
                   class="btn-pdf w-100">

                    Download PDF

                </a>

            </div>

        </div>

    </div>

</form>


<!-- TABLE -->
<div class="custom-card">

    <div class="table-responsive">

        <table class="table align-middle">

            <thead>

                <tr>

                    <th>Tanggal</th>
                    <th>Jadwal</th>
                    <th width="120">Hadir</th>
                    <th width="120">Izin</th>
                    <th width="140">Tidak Hadir</th>

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

                        <!-- TANGGAL -->
                        <td>

                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}

                        </td>


                        <!-- JADWAL -->
                        <td>

                            <div class="jadwal-day">

                                {{ ucfirst($item->jadwal->hari) }}

                            </div>

                            <div class="jadwal-time">

                                {{ \Carbon\Carbon::parse($item->jadwal->jam_mulai)->format('H.i') }}
                                -
                                {{ \Carbon\Carbon::parse($item->jadwal->jam_selesai)->format('H.i') }}

                            </div>

                        </td>


                        <!-- HADIR -->
                        <td class="text-center">

                            <span class="badge-custom badge-hadir">

                                {{ $hadir }}

                            </span>

                        </td>


                        <!-- IZIN -->
                        <td class="text-center">

                            <span class="badge-custom badge-izin">

                                {{ $izin }}

                            </span>

                        </td>


                        <!-- TIDAK HADIR -->
                        <td class="text-center">

                            <span class="badge-custom badge-tidak">

                                {{ $tidak }}

                            </span>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5">

                            <div class="empty-state">

                                <div class="empty-icon">
                                    📅
                                </div>

                                <div class="empty-text">

                                    Belum ada sesi latihan pada bulan ini

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