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

    /* SEARCH */

    .search-box{
        position:relative;
    }

    .search-box input{

        height:54px;

        border:none;

        border-radius:18px;

        background:#f8fafc;

        padding:0 20px;

        font-size:14px;

        transition:0.2s;
    }

    .search-box input:focus{

        background:white;

        box-shadow:
            0 0 0 4px rgba(14,165,233,0.12);

        border:none;
    }

    /* BUTTON */

    .btn-search{

        height:54px;

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

    .btn-search:hover{

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

    .table tbody tr{
        transition:0.2s;
    }

    .table tbody tr:hover{
        transform:translateY(-2px);
    }

    .table tbody td{

        background:white;

        padding:18px 16px;

        vertical-align:middle;

        border:none;
    }

    .table tbody tr td:first-child{
        border-radius:18px 0 0 18px;
    }

    .table tbody tr td:last-child{
        border-radius:0 18px 18px 0;
    }

    /* USER */

    .user-info{

        display:flex;
        align-items:center;

        gap:14px;
    }

    .avatar{

        width:46px;
        height:46px;

        border-radius:16px;

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

        font-size:16px;
    }

    .user-name{

        font-weight:600;

        color:#0f172a;

        margin-bottom:2px;
    }

    .user-email{

        font-size:13px;

        color:#64748b;
    }

    /* BADGE */

    .gender-badge{

        padding:8px 14px;

        border-radius:12px;

        font-size:12px;
        font-weight:600;

        display:inline-block;
    }

    .male{
        background:#dbeafe;
        color:#1d4ed8;
    }

    .female{
        background:#fee2e2;
        color:#be123c;
    }

    /* ACTION */

    .action-group{

        display:flex;

        gap:10px;
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

    .btn-rekap{

        background:#dcfce7;
        color:#166534;
    }

    /* EMPTY */

    .empty-state{

        padding:60px 20px;

        text-align:center;
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

    <h3>
        Data Atlet
    </h3>

    <p>
        Monitoring data atlet oleh pelatih
    </p>

</div>


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

                <button class="btn-search w-100">

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
                    <th width="220">Aksi</th>

                </tr>

            </thead>

            <tbody>

                @forelse($data as $d)

                <tr>

                    <!-- USER -->
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


                    <!-- GENDER -->
                    <td>

                        <span class="gender-badge
                        
                            {{ $d->jenis_kelamin == 'Laki-laki'
                                ? 'male'
                                : 'female' }}
                        
                        ">

                            {{ $d->jenis_kelamin }}

                        </span>

                    </td>


                    <!-- PHONE -->
                    <td>

                        {{ $d->user->no_hp }}

                    </td>


                    <!-- ACTION -->
                    <td>

                        <div class="action-group">

                            <a href="/pelatih/atlet/{{ $d->id }}"
                               class="btn-action btn-detail">

                                Detail

                            </a>

                            <a href="/pelatih/rekap-atlet/{{ $d->id }}"
                               class="btn-action btn-rekap">

                                Rekap

                            </a>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4">

                        <div class="empty-state">

                            <div class="empty-icon">
                                🏃‍♂️
                            </div>

                            <div class="empty-text">

                                Belum ada data atlet

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

        {{ $data->links() }}

    </div>

</div>

@endsection