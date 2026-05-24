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

    .history-card{

        background:white;

        border:none;

        border-radius:24px;

        padding:24px;

        box-shadow:
            0 4px 20px rgba(15,23,42,0.05);
    }

    /* SEARCH */

    .search-box .form-control{

        border-radius:14px;

        border:1px solid #cbd5e1;

        padding:12px 14px;

        box-shadow:none !important;
    }

    .search-box .form-control:focus{

        border-color:#3b82f6;

        box-shadow:
            0 0 0 4px rgba(59,130,246,0.1) !important;
    }

    .btn-search{

        border-radius:14px;

        padding:12px;

        font-weight:600;

        text-decoration:none;
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

        text-transform:uppercase;
    }

    .table tbody tr{
        background:white;
    }

    .table tbody td{

        border:none;

        padding:18px 16px;

        vertical-align:middle;

        background:white;
    }

    .table tbody tr td:first-child{
        border-radius:16px 0 0 16px;
    }

    .table tbody tr td:last-child{
        border-radius:0 16px 16px 0;
    }

    /* STATUS */

    .status-badge{

        padding:8px 14px;

        border-radius:12px;

        font-size:13px;

        font-weight:600;

        display:inline-flex;

        align-items:center;

        gap:6px;
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

    /* EVALUASI */

    .evaluasi-box{

        background:#f8fafc;

        border:1px solid #e2e8f0;

        border-radius:16px;

        padding:14px;
    }

    .evaluasi-item{

        display:flex;

        justify-content:space-between;

        padding:6px 0;

        border-bottom:1px solid #e2e8f0;
    }

    .evaluasi-item:last-child{
        border:none;
    }

    .evaluasi-item span{
        color:#64748b;
    }

    .evaluasi-item b{
        color:#0f172a;
    }

    /* EMPTY */

    .empty-state{
        padding:50px 20px;
    }

    .empty-icon{
        font-size:48px;
    }

    .pagination{
        justify-content:end;
    }

    .page-link{
        border:none;
        border-radius:10px;
        margin:0 3px;
        color:#0f172a;
    }

    .page-item.active .page-link{
        background:#3b82f6;
    }

</style>


{{-- HEADER --}}
<div class="page-title">

    <h3>
        Riwayat Absensi Saya
    </h3>

    <p>
        Monitor kehadiran dan evaluasi latihan atlet
    </p>

</div>


{{-- SEARCH --}}
<form method="GET" class="mb-4">

    <div class="row search-box">

        <div class="col-md-4">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Cari tanggal atau hari latihan...">

        </div>

        <div class="col-md-2">

            <button class="btn btn-primary btn-search w-100">
                Search
            </button>

        </div>

    </div>

</form>


{{-- TABLE --}}
<div class="history-card">

    <table class="table align-middle">

        <thead class="text-center">

            <tr>

                <th width="180">
                    Tanggal
                </th>

                <th>
                    Jadwal
                </th>

                <th width="170">
                    Status
                </th>

                <th>
                    Evaluasi
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($data as $d)

            <tr>

                {{-- TANGGAL --}}
                <td class="text-center fw-semibold">

                    {{ \Carbon\Carbon::parse($d->absensi->tanggal)->translatedFormat('d F Y') }}

                </td>


                {{-- JADWAL --}}
                <td>

                    <div class="fw-bold text-dark">

                        {{ ucfirst($d->absensi->jadwal->hari) }}

                    </div>

                    <small class="text-muted">

                        {{ \Carbon\Carbon::parse($d->absensi->jadwal->jam_mulai)->format('H.i') }}
                        -
                        {{ \Carbon\Carbon::parse($d->absensi->jadwal->jam_selesai)->format('H.i') }}

                    </small>

                </td>


                {{-- STATUS --}}
                <td class="text-center">

                    @if($d->status == 'hadir')

                        <span class="status-badge hadir">
                            Hadir
                        </span>

                    @elseif($d->status == 'izin')

                        <span class="status-badge izin">
                            Izin
                        </span>

                    @else

                        <span class="status-badge alpha">
                            Tidak Hadir
                        </span>

                    @endif

                </td>


                {{-- EVALUASI --}}
                <td>

                    <div class="evaluasi-box">

                        <div class="evaluasi-item">

                            <span>
                                Teknik
                            </span>

                            <b>
                                {{ $d->evaluasi_teknik ?? '-' }}
                            </b>

                        </div>

                        <div class="evaluasi-item">

                            <span>
                                Fisik
                            </span>

                            <b>
                                {{ $d->evaluasi_fisik ?? '-' }}
                            </b>

                        </div>

                        <div class="evaluasi-item">

                            <span>
                                Mental
                            </span>

                            <b>
                                {{ $d->evaluasi_mental ?? '-' }}
                            </b>

                        </div>

                    </div>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="4">

                    <div class="empty-state text-center">

                        <div class="empty-icon">
                            📋
                        </div>

                        <div class="text-muted mt-3">

                            Belum ada riwayat absensi

                        </div>

                    </div>

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