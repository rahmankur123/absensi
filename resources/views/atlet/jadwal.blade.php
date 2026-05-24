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

    .schedule-card{

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

    .day-badge{

        display:inline-flex;

        align-items:center;

        justify-content:center;

        min-width:120px;

        padding:10px 16px;

        border-radius:14px;

        background:#dbeafe;

        color:#1d4ed8;

        font-weight:700;
    }

    .time-box{

        display:inline-block;

        padding:10px 16px;

        border-radius:14px;

        background:#f8fafc;

        color:#0f172a;

        font-weight:600;
    }

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
        Jadwal Latihan
    </h3>

    <p>
        Informasi jadwal latihan atlet BD Camp
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
                   placeholder="Cari hari latihan...">

        </div>

        <div class="col-md-2">

            <button class="btn btn-primary btn-search w-100">
                Search
            </button>

        </div>

    </div>

</form>


{{-- TABLE --}}
<div class="schedule-card">

    <table class="table align-middle text-center">

        <thead>

            <tr>

                <th width="250">
                    Hari
                </th>

                <th>
                    Jam Mulai
                </th>

                <th>
                    Jam Selesai
                </th>

            </tr>

        </thead>

        <tbody>

            @forelse($data as $d)

            <tr>

                {{-- HARI --}}
                <td>

                    <span class="day-badge">
                        {{ ucfirst($d->hari) }}
                    </span>

                </td>

                {{-- JAM MULAI --}}
                <td>

                    <span class="time-box">

                        {{ \Carbon\Carbon::parse($d->jam_mulai)->format('H.i') }}

                    </span>

                </td>

                {{-- JAM SELESAI --}}
                <td>

                    <span class="time-box">

                        {{ \Carbon\Carbon::parse($d->jam_selesai)->format('H.i') }}

                    </span>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="3">

                    <div class="empty-state">

                        <div class="empty-icon">
                            📅
                        </div>

                        <div class="text-muted mt-3">

                            Belum ada jadwal latihan tersedia

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