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

    .btn-create{

        height:52px;

        border:none;

        border-radius:18px;

        padding:0 24px;

        background:
            linear-gradient(
                135deg,
                #0ea5e9,
                #6366f1
            );

        color:white;

        font-weight:600;

        transition:0.3s;
    }

    .btn-create:hover{

        transform:translateY(-2px);

        color:white;
    }

    /* SEARCH */

    .search-box input{

        height:54px;

        border:none;

        border-radius:18px;

        background:#f8fafc;

        padding:0 20px;

        transition:0.2s;
    }

    .search-box input:focus{

        background:white;

        border:none;

        box-shadow:
            0 0 0 4px rgba(14,165,233,0.12);
    }

    .btn-search{

        height:54px;

        border:none;

        border-radius:18px;

        background:#0f172a;

        color:white;

        font-weight:600;
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

    .jadwal-title{

        font-weight:700;

        color:#0f172a;

        margin-bottom:4px;
    }

    .jadwal-time{

        font-size:13px;

        color:#64748b;
    }

    /* REKAP */

    .rekap-group{

        display:flex;

        gap:8px;

        flex-wrap:wrap;
    }

    .rekap-box{

        padding:8px 12px;

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

    /* STATUS */

    .status-badge{

        padding:8px 14px;

        border-radius:12px;

        font-size:12px;
        font-weight:600;
    }

    .open{
        background:#dcfce7;
        color:#166534;
    }

    .close{
        background:#fee2e2;
        color:#991b1b;
    }

    /* ACTION */

    .action-group{

        display:flex;

        gap:10px;

        flex-wrap:wrap;
    }

    .btn-action{

        border:none;

        border-radius:14px;

        padding:10px 16px;

        font-size:13px;
        font-weight:600;

        transition:0.2s;
    }

    .btn-action:hover{
        transform:translateY(-2px);
    }

    .btn-detail{

        background:#dbeafe;
        color:#1d4ed8;
    }

    .btn-toggle{

        background:#fef3c7;
        color:#92400e;
    }

    .btn-delete{

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
            Data Absensi
        </h3>

        <p>
            Monitoring data kehadiran latihan atlet
        </p>

    </div>

    <a href="{{ route('pelatih.absensi.create') }}"
       class="btn btn-create d-flex align-items-center gap-2">

        + Buat Absensi

    </a>

</div>


<!-- ALERT -->
@if(session('success'))

<div class="custom-alert">

    {{ session('success') }}

</div>

@endif


<!-- SEARCH -->
<form method="GET" class="mb-4">

    <div class="row g-3">

        <div class="col-md-4">

            <div class="search-box">

                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control"
                       placeholder="Cari hari / tanggal absensi...">

            </div>

        </div>

        <div class="col-md-2">

            <button class="btn-search w-100">

                Search

            </button>

        </div>

    </div>

</form>


<!-- TABLE -->
<div class="custom-card">

    <div class="table-responsive">

        <table class="table align-middle">

            <thead>

                <tr>

                    <th>Jadwal</th>
                    <th width="180">Tanggal</th>
                    <th width="230">Rekap</th>
                    <th width="140">Status</th>
                    <th width="260">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($absensis as $absen)

                <tr>

                    <!-- JADWAL -->
                    <td>

                        <div class="jadwal-title">

                            {{ ucfirst($absen->jadwal->hari) }}

                        </div>

                        <div class="jadwal-time">

                            {{ \Carbon\Carbon::parse($absen->jadwal->jam_mulai)->format('H.i') }}
                            -
                            {{ \Carbon\Carbon::parse($absen->jadwal->jam_selesai)->format('H.i') }}

                        </div>

                    </td>


                    <!-- TANGGAL -->
                    <td>

                        {{ \Carbon\Carbon::parse($absen->tanggal)->translatedFormat('d F Y') }}

                    </td>


                    <!-- REKAP -->
                    <td>

                        <div class="rekap-group">

                            <div class="rekap-box hadir">

                                H: {{ $absen->hadir_count }}

                            </div>

                            <div class="rekap-box izin">

                                I: {{ $absen->izin_count ?? 0 }}

                            </div>

                            <div class="rekap-box tidak">

                                T: {{ $absen->tidak_hadir_count }}

                            </div>

                        </div>

                    </td>


                    <!-- STATUS -->
                    <td>

                        @if($absen->status == 'buka')

                            <span class="status-badge open">

                                Dibuka

                            </span>

                        @else

                            <span class="status-badge close">

                                Ditutup

                            </span>

                        @endif

                    </td>


                    <!-- ACTION -->
                    <td>

                        <div class="action-group">

                            <a href="{{ route('pelatih.absensi.detail', $absen->id) }}"
                               class="btn-action btn-detail">

                                Detail

                            </a>


                            <a href="{{ route('pelatih.absensi.toggle', $absen->id) }}"
                               class="btn-action btn-toggle">

                                {{ $absen->status == 'buka' ? 'Tutup' : 'Buka' }}

                            </a>


                            <form action="{{ route('pelatih.absensi.delete', $absen->id) }}"
                                  method="POST"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button class="btn-action btn-delete"
                                    onclick="return confirm('Yakin hapus absensi ini?')">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5">

                        <div class="empty-state">

                            <div class="empty-icon">
                                📋
                            </div>

                            <div class="empty-text">

                                Belum ada data absensi

                            </div>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <!-- PAGINATION -->
    <div class="mt-4">

        {{ $absensis->links() }}

    </div>

</div>

@endsection