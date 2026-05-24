@extends('layouts.app')

@section('content')

<style>

    .page-title{
        margin-bottom:24px;
    }

    .page-title h4{
        font-weight:700;
        color:#0f172a;
        margin:0;
    }

    .custom-card{
        border:none;
        border-radius:24px;
        background:white;
        box-shadow:0 4px 20px rgba(15,23,42,0.05);
    }

    .custom-table{
        border-collapse:separate;
        border-spacing:0 12px;
    }

    .custom-table thead th{
        border:none;
        color:#64748b;
        font-size:13px;
        font-weight:600;
        background:transparent;
    }

    .custom-table tbody tr{
        background:white;
    }

    .custom-table tbody td{
        border:none;
        padding:18px 16px;
        vertical-align:middle;
        background:white;
    }

    .custom-table tbody tr td:first-child{
        border-radius:16px 0 0 16px;
    }

    .custom-table tbody tr td:last-child{
        border-radius:0 16px 16px 0;
    }

    .schedule-badge{
        display:inline-block;
        padding:8px 14px;
        border-radius:12px;
        background:#eff6ff;
        color:#2563eb;
        font-size:13px;
        font-weight:600;
    }

    .search-box{
        border-radius:14px;
        border:1px solid #e2e8f0;
        padding:12px 14px;
    }

    .btn-custom{
        border-radius:14px;
        padding:10px 18px;
        font-weight:600;
    }

</style>

{{-- HEADER --}}
<div class="page-title">
    <h4>Jadwal Latihan</h4>
</div>

{{-- SEARCH --}}
<form method="GET" class="mb-4">

    <div class="row g-3">

        <div class="col-md-4">

            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   class="form-control search-box"
                   placeholder="Cari hari latihan...">

        </div>

        <div class="col-md-2">

            <button class="btn btn-primary btn-custom w-100">
                Search
            </button>

        </div>

    </div>

</form>

{{-- TABLE --}}
<div class="custom-card p-4">

    <table class="table custom-table align-middle">

        <thead>

            <tr>
                <th width="220">Hari</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
            </tr>

        </thead>

        <tbody>

            @forelse($data as $d)

            <tr>

                <td>
                    <span class="schedule-badge">
                        {{ ucfirst($d->hari) }}
                    </span>
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($d->jam_mulai)->format('H.i') }}
                </td>

                <td>
                    {{ \Carbon\Carbon::parse($d->jam_selesai)->format('H.i') }}
                </td>

            </tr>

            @empty

            <tr>

                <td colspan="3" class="text-center py-5">

                    <div style="font-size:44px;">
                        📅
                    </div>

                    <div class="text-muted mt-2">
                        Belum ada jadwal latihan tersedia
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