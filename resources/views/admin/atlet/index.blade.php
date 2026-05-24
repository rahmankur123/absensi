@extends('layouts.app')

@section('content')

<style>

    .page-header{

        display:flex;
        justify-content:space-between;
        align-items:center;

        margin-bottom:28px;
    }

    .page-title h3{
        font-weight:700;
        margin-bottom:4px;
        color:#0f172a;
    }

    .page-title p{
        margin:0;
        color:#64748b;
        font-size:14px;
    }

    /* CARD */

    .custom-card{

        background:white;

        border:none;

        border-radius:24px;

        padding:24px;

        box-shadow:
            0 4px 20px rgba(15,23,42,0.04);
    }

    /* SEARCH */

    .search-box{
        position:relative;
    }

    .search-box input{

        height:52px;

        border:none;

        border-radius:16px;

        background:#f8fafc;

        padding-left:18px;

        font-size:14px;
    }

    .search-box input:focus{
        box-shadow:none;
        background:#f1f5f9;
    }

    /* BUTTON */

    .btn-modern{

        text-decoration:none;

        height:52px;

        border:none;

        border-radius:16px;

        padding:0 22px;

        font-weight:600;

        background:
            linear-gradient(
                135deg,
                #0ea5e9,
                #6366f1
            );

        color:white;

        transition:0.3s;
    }

    .btn-modern:hover{
        transform:translateY(-2px);
        color:white;
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

        padding:0 16px 10px;
    }

    .table tbody tr{
        transition:0.2s;
    }

    .table tbody tr:hover{
        transform:scale(1.01);
    }

    .table tbody td{

        background:white;

        padding:18px 16px;

        vertical-align:middle;

        border:none;
    }

    .table tbody tr td:first-child{
        border-radius:16px 0 0 16px;
    }

    .table tbody tr td:last-child{
        border-radius:0 16px 16px 0;
    }

    /* USER */

    .user-info{
        display:flex;
        align-items:center;
        gap:14px;
    }

    .avatar{

        width:42px;
        height:42px;

        border-radius:14px;

        background:
            linear-gradient(
                135deg,
                #0ea5e9,
                #6366f1
            );

        color:white;

        display:flex;
        align-items:center;
        justify-content:center;

        font-weight:700;
    }

    .user-name{
        font-weight:600;
        color:#0f172a;
    }

    .user-email{
        font-size:13px;
        color:#64748b;
    }

    /* BELT */

    .belt-badge{

        padding:8px 14px;

        border-radius:12px;

        font-size:12px;
        font-weight:600;

        display:inline-block;
    }

    .putih{
        background:#f8fafc;
        color:#475569;
    }

    .kuning{
        background:#fef3c7;
        color:#92400e;
    }

    .hijau{
        background:#dcfce7;
        color:#166534;
    }

    .biru{
        background:#dbeafe;
        color:#1d4ed8;
    }

    .coklat{
        background:#ede0d4;
        color:#7c2d12;
    }

    .hitam{
        background:#0f172a;
        color:white;
    }

    /* ACTION */

    .action-group{
        display:flex;
        gap:8px;
        flex-wrap:wrap;
    }

    .btn-action{

        text-decoration:none;

        border:none;

        border-radius:12px;

        padding:8px 14px;

        font-size:13px;
        font-weight:600;

        transition:0.2s;
    }

    .btn-action:hover{
        transform:translateY(-2px);
    }

    .btn-info-soft{
        background:#dbeafe;
        color:#1d4ed8;
    }

    .btn-warning-soft{
        background:#fef3c7;
        color:#92400e;
    }

    .btn-danger-soft{
        background:#fee2e2;
        color:#b91c1c;
    }

</style>


<!-- HEADER -->
<div class="page-header">

    <div class="page-title">

        <h3>
            Data Atlet
        </h3>

        <p>
            Kelola seluruh data atlet BD Camp
        </p>

    </div>

    <a href="/admin/atlet/create"
       class="btn-modern d-flex align-items-center">

        + Tambah Atlet

    </a>

</div>


<!-- CARD -->
<div class="custom-card">

    <!-- SEARCH -->
    <form method="GET" class="mb-4">

        <div class="row g-3">

            <div class="col-md-4">

                <div class="search-box">

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           class="form-control"
                           placeholder="Cari nama / email atlet...">

                </div>

            </div>

            <div class="col-md-2">

                <button class="btn-modern w-100">
                    Search
                </button>

            </div>

        </div>

    </form>


    <!-- TABLE -->
    <div class="table-responsive">

        <table class="table align-middle">

            <thead>

                <tr>

                    <th>Atlet</th>
                    <th>Jenis Kelamin</th>
                    <th>No HP</th>
                    <th>Sabuk</th>
                    <th width="240">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($data as $d)

                <tr>

                    <td>

                        <div class="user-info">

                            <div class="avatar">
                                {{ strtoupper(substr($d->user->nama,0,1)) }}
                            </div>

                            <div>

                                <div class="user-name">
                                    {{ $d->user->nama }}
                                </div>

                                <div class="user-email">
                                    {{ $d->user->email }}
                                </div>

                            </div>

                        </div>

                    </td>

                    <td>
                        {{ $d->jenis_kelamin }}
                    </td>

                    <td>
                        {{ $d->user->no_hp }}
                    </td>

                    <td>

                        <span class="belt-badge
                        
                            @if($d->sabuk == 'Putih') putih
                            @elseif($d->sabuk == 'Kuning') kuning
                            @elseif($d->sabuk == 'Hijau') hijau
                            @elseif($d->sabuk == 'Biru') biru
                            @elseif($d->sabuk == 'Coklat') coklat
                            @elseif($d->sabuk == 'Hitam') hitam
                            @endif
                        
                        ">

                            {{ $d->sabuk }}

                        </span>

                    </td>

                    <td>

                        <div class="action-group">

                            <a href="/admin/rekap-atlet/{{ $d->id }}"
                               class="btn-action btn-info-soft">

                                Rekap

                            </a>

                            <a href="/admin/atlet/edit/{{ $d->id }}"
                               class="btn-action btn-warning-soft">

                                Edit

                            </a>

                            <a href="/admin/atlet/delete/{{ $d->id }}"
                               class="btn-action btn-danger-soft"
                               onclick="return confirm('Yakin hapus data?')">

                                Hapus

                            </a>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5"
                        class="text-center text-muted py-5">

                        Data atlet tidak ditemukan

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    <!-- PAGINATION -->
    <div class="mt-4">

        {{ $data->links() }}

    </div>

</div>

@endsection