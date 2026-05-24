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

    /* ALERT */

    .custom-alert{

        background:#dcfce7;

        color:#166534;

        border:none;

        border-radius:18px;

        padding:16px 20px;

        margin-bottom:22px;

        font-weight:500;
    }

    /* BUTTON */

    .btn-back{

        border:none;

        border-radius:16px;

        padding:12px 20px;

        background:#e2e8f0;

        color:#0f172a;

        font-weight:600;
    }

    .btn-action{

        border:none;

        border-radius:16px;

        padding:12px 20px;

        font-weight:600;

        transition:0.2s;
        width:fit-content;
    }

    .btn-action:hover{
        transform:translateY(-2px);
    }

    .btn-edit{
        background:#fef3c7;
        color:#92400e;
        height:52px;
    }

    .btn-update{
        background:#0f172a;
        color:white;
    }

    .btn-close{
        background:#fee2e2;
        color:#991b1b;
    }

    .btn-open{
        background:#dcfce7;
        color:#166534;
    }

    .btn-cancel{
        background:#e2e8f0;
        color:#334155;
    }

    /* INFO */

    .info-grid{

        display:grid;

        grid-template-columns:repeat(2,1fr);

        gap:20px;
    }

    .info-item{

        background:#f8fafc;

        border-radius:18px;

        padding:18px;
    }

    .info-label{

        color:#64748b;

        font-size:13px;

        margin-bottom:6px;
    }

    .info-value{

        font-weight:700;

        color:#0f172a;
    }

    /* STATUS */

    .status-badge{

        display:inline-flex;

        align-items:center;

        padding:10px 16px;

        border-radius:14px;

        font-size:13px;
        font-weight:600;

        margin-top:20px;
    }

    .status-open{
        background:#dcfce7;
        color:#166534;
    }

    .status-close{
        background:#fee2e2;
        color:#991b1b;
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

        width:120px;
        height:120px;

        right:-35px;
        top:-35px;

        border-radius:50%;

        background:rgba(255,255,255,0.12);
    }

    .summary-title{

        font-size:14px;

        opacity:0.9;
    }

    .summary-value{

        font-size:34px;

        font-weight:700;

        margin-top:10px;
    }

    /* FILTER */

    .filter-box{

        width:220px;

        height:52px;

        border:none;

        border-radius:18px;

        background:#f8fafc;

        padding:0 16px;
    }

    .filter-box:focus{

        outline:none;

        box-shadow:
            0 0 0 4px rgba(14,165,233,0.12);
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

    /* BADGE */

    .badge-status{

        padding:8px 14px;

        border-radius:12px;

        font-size:12px;
        font-weight:600;
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

    /* INPUT */

    .custom-input{

        height:48px;

        border:none;

        border-radius:14px;

        background:#f8fafc;

        padding:0 14px;
    }

    .custom-input:focus{

        outline:none;

        box-shadow:
            0 0 0 4px rgba(14,165,233,0.10);
    }

    .custom-file{

        border:none;

        border-radius:14px;

        background:#f8fafc;

        padding:10px 14px;
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


<form action="/pelatih/absensi/update/{{ $data->id }}"
      method="POST"
      enctype="multipart/form-data">

@csrf


<!-- HEADER -->
<div class="page-header">

    <div class="page-title">

        <h3>
            Detail Absensi
        </h3>

        <p>
            Detail kehadiran dan evaluasi latihan atlet
        </p>

    </div>

    <a href="/pelatih/absensi"
       class="btn-back">

        Kembali

    </a>

</div>


<!-- ALERT -->
@if(session('success'))

<div class="custom-alert">

    {{ session('success') }}

</div>

@endif


<!-- INFO -->
<div class="custom-card mb-4">

    <div class="info-grid">

        <div class="info-item">

            <div class="info-label">
                Tanggal
            </div>

            <div class="info-value">

                {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}

            </div>

        </div>


        <div class="info-item">

            <div class="info-label">
                Jadwal Latihan
            </div>

            <div class="info-value">

                {{ ucfirst($data->jadwal->hari) }}

                (
                {{ \Carbon\Carbon::parse($data->jadwal->jam_mulai)->format('H.i') }}
                -
                {{ \Carbon\Carbon::parse($data->jadwal->jam_selesai)->format('H.i') }}
                )

            </div>

        </div>

    </div>


    @if($data->status == 'buka')

        <div class="status-badge status-open">

            Absensi Dibuka

        </div>

    @else

        <div class="status-badge status-close">

            Absensi Ditutup

        </div>

    @endif

</div>


<!-- SUMMARY -->
@php
    $hadir = $data->kehadiran->where('status','hadir')->count();
    $izin = $data->kehadiran->where('status','izin')->count();
    $tidak = $data->kehadiran->where('status','tidak_hadir')->count();
@endphp

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


<!-- FILTER -->
<div class="mb-4">

    <select id="filterStatus"
            class="filter-box">

        <option value="all">Semua Status</option>
        <option value="hadir">Hadir</option>
        <option value="izin">Izin</option>
        <option value="tidak_hadir">Tidak Hadir</option>

    </select>

</div>


<!-- TABLE -->
<div class="custom-card">

    <div class="table-responsive">

        <table class="table align-middle">

            <thead>

                <tr>

                    <th>Nama Atlet</th>
                    <th width="180">Status</th>
                    <th>Teknik</th>
                    <th>Fisik</th>
                    <th>Mental</th>
                    <th width="160">Bukti</th>

                </tr>

            </thead>

            <tbody>

                @forelse($data->kehadiran as $k)

                <tr data-status="{{ $k->status }}">

                    <!-- NAMA -->
                    <td>

                        <b>
                            {{ $k->atlet->user->nama }}
                        </b>

                    </td>


                    <!-- STATUS -->
                    <td>

                        @if($mode == 'edit' && $data->status == 'buka')

                            <select name="status[{{ $k->id }}]"
                                    class="custom-input w-100">

                                <option value="hadir"
                                    {{ $k->status=='hadir'?'selected':'' }}>

                                    Hadir

                                </option>

                                <option value="izin"
                                    {{ $k->status=='izin'?'selected':'' }}>

                                    Izin

                                </option>

                                <option value="tidak_hadir"
                                    {{ $k->status=='tidak_hadir'?'selected':'' }}>

                                    Tidak Hadir

                                </option>

                            </select>

                        @else

                            <span class="badge-status

                                @if($k->status=='hadir')
                                    hadir
                                @elseif($k->status=='izin')
                                    izin
                                @else
                                    tidak
                                @endif">

                                {{ ucfirst(str_replace('_',' ',$k->status)) }}

                            </span>

                        @endif

                    </td>


                    <!-- TEKNIK -->
                    <td>

                        @if($k->status == 'hadir' && $mode == 'edit' && $data->status == 'buka')

                            <input type="text"
                                   name="evaluasi_teknik[{{ $k->id }}]"
                                   value="{{ $k->evaluasi_teknik }}"
                                   class="custom-input w-100">

                        @elseif($k->status == 'hadir')

                            {{ $k->evaluasi_teknik ?? '-' }}

                        @else

                            -

                        @endif

                    </td>


                    <!-- FISIK -->
                    <td>

                        @if($k->status == 'hadir' && $mode == 'edit' && $data->status == 'buka')

                            <input type="text"
                                   name="evaluasi_fisik[{{ $k->id }}]"
                                   value="{{ $k->evaluasi_fisik }}"
                                   class="custom-input w-100">

                        @elseif($k->status == 'hadir')

                            {{ $k->evaluasi_fisik ?? '-' }}

                        @else

                            -

                        @endif

                    </td>


                    <!-- MENTAL -->
                    <td>

                        @if($k->status == 'hadir' && $mode == 'edit' && $data->status == 'buka')

                            <input type="text"
                                   name="evaluasi_mental[{{ $k->id }}]"
                                   value="{{ $k->evaluasi_mental }}"
                                   class="custom-input w-100">

                        @elseif($k->status == 'hadir')

                            {{ $k->evaluasi_mental ?? '-' }}

                        @else

                            -

                        @endif

                    </td>


                    <!-- BUKTI -->
                    <td>

                        @if(($k->status == 'hadir' || $k->status == 'izin') && $mode == 'edit' && $data->status == 'buka')

                            <input type="file"
                                   name="bukti[{{ $k->id }}]"
                                   class="custom-file w-100">

                        @elseif($k->bukti)

                            <a href="{{ asset('storage/'.$k->bukti) }}"
                               target="_blank"
                               class="btn-action btn-update">

                                Lihat

                            </a>

                        @else

                            -

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6">

                        <div class="empty-state">

                            <div class="empty-icon">
                                📭
                            </div>

                            <div class="empty-text">

                                Belum ada data kehadiran

                            </div>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


<!-- ACTION -->
<div class="d-flex gap-3 mt-4 flex-wrap">

    @if($mode == 'view' && $data->status == 'buka')

        <a href="/pelatih/absensi/detail/{{ $data->id }}?mode=edit"
           class="btn-action btn-edit">

            Edit

        </a>

    @endif


    @if($mode == 'edit')

        <a href="/pelatih/absensi/detail/{{ $data->id }}"
           class="btn-action btn-cancel">

            Batal

        </a>

        <button class="btn-action btn-update">

            Update

        </button>

    @endif


    @if($data->status == 'buka')

        <a href="/pelatih/absensi/toggle/{{ $data->id }}"
           class="btn-action btn-close">

            Tutup

        </a>

    @else

        <a href="/pelatih/absensi/toggle/{{ $data->id }}"
           class="btn-action btn-open">

            Buka

        </a>

    @endif

</div>

</form>


<!-- FILTER SCRIPT -->
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