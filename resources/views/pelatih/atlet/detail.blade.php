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

        border-radius:30px;

        padding:32px;

        box-shadow:
            0 10px 35px rgba(15,23,42,0.05);
    }

    /* PROFILE */

    .profile-section{
        text-align:center;
        margin-bottom:40px;
    }

    .profile-photo{

        width:150px;
        height:150px;

        border-radius:32px;

        object-fit:cover;

        border:5px solid white;

        box-shadow:
            0 15px 35px rgba(15,23,42,0.12);
    }

    .profile-name{

        margin-top:18px;

        font-size:24px;
        font-weight:700;

        color:#0f172a;
    }

    .profile-email{

        color:#64748b;

        font-size:14px;
    }

    /* INFO */

    .info-card{

        background:#f8fafc;

        border-radius:22px;

        padding:22px;

        height:100%;
    }

    .info-label{

        font-size:13px;
        font-weight:600;

        color:#64748b;

        margin-bottom:8px;
    }

    .info-value{

        font-size:16px;
        font-weight:600;

        color:#0f172a;

        word-break:break-word;
    }

    /* SECTION */

    .section-title{

        font-size:20px;
        font-weight:700;

        color:#0f172a;

        margin-bottom:20px;
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

    .alpha{
        background:#fee2e2;
        color:#991b1b;
    }

    /* SCORE */

    .score-box{

        padding:8px 12px;

        border-radius:12px;

        background:#eff6ff;

        color:#2563eb;

        font-weight:600;

        display:inline-block;

        min-width:50px;

        text-align:center;
    }

    /* EMPTY */

    .empty-state{

        text-align:center;

        padding:60px 20px;
    }

    .empty-icon{
        font-size:46px;
        margin-bottom:10px;
    }

    .empty-text{
        color:#64748b;
    }

    /* BUTTON */

    .btn-back{

        height:52px;

        border:none;

        border-radius:18px;

        padding:0 26px;

        background:#e2e8f0;

        color:#334155;

        font-weight:600;

        transition:0.2s;
    }

    .btn-back:hover{
        background:#cbd5e1;
    }

</style>


<!-- HEADER -->
<div class="page-header">

    <h3>
        Detail Atlet
    </h3>

    <p>
        Informasi lengkap profil dan riwayat latihan atlet
    </p>

</div>


<!-- PROFILE -->
<div class="custom-card mb-4">

    <div class="profile-section">

        <img src="{{ $data->user->foto ? asset('storage/'.$data->user->foto) : 'https://via.placeholder.com/150' }}"
             class="profile-photo">

        <div class="profile-name">

            {{ $data->user->nama }}

        </div>

        <div class="profile-email">

            {{ $data->user->email }}

        </div>

    </div>


    <!-- INFO -->
    <div class="row g-4">

        <div class="col-md-4">

            <div class="info-card">

                <div class="info-label">
                    No HP
                </div>

                <div class="info-value">
                    {{ $data->user->no_hp }}
                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="info-card">

                <div class="info-label">
                    Jenis Kelamin
                </div>

                <div class="info-value">
                    {{ $data->jenis_kelamin }}
                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="info-card">

                <div class="info-label">
                    Tanggal Lahir
                </div>

                <div class="info-value">
                    {{ \Carbon\Carbon::parse($data->tanggal_lahir)->translatedFormat('d F Y') }}
                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="info-card">

                <div class="info-label">
                    Berat Badan
                </div>

                <div class="info-value">
                    {{ $data->berat_badan }} kg
                </div>

            </div>

        </div>


        <div class="col-md-4">

            <div class="info-card">

                <div class="info-label">
                    Tinggi Badan
                </div>

                <div class="info-value">
                    {{ $data->tinggi_badan }} cm
                </div>

            </div>

        </div>


        <div class="col-md-12">

            <div class="info-card">

                <div class="info-label">
                    Alamat
                </div>

                <div class="info-value">
                    {{ $data->alamat }}
                </div>

            </div>

        </div>

    </div>

</div>


<!-- HISTORY -->
<div class="custom-card">

    <div class="section-title">

        Riwayat Latihan

    </div>


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

                @forelse($data->kehadiran as $k)

                <tr>

                    <td>

                        {{ \Carbon\Carbon::parse($k->tanggal)->translatedFormat('d F Y') }}

                    </td>

                    <td>

                        {{ ucfirst($k->absensi->jadwal->hari) }}

                    </td>

                    <td>

                        <span class="status-badge
                        
                            @if($k->status == 'hadir')
                                hadir
                            @elseif($k->status == 'izin')
                                izin
                            @else
                                alpha
                            @endif
                        
                        ">

                            {{ ucfirst($k->status) }}

                        </span>

                    </td>

                    <td>

                        <span class="score-box">

                            {{ $k->evaluasi_teknik ?? '-' }}

                        </span>

                    </td>

                    <td>

                        <span class="score-box">

                            {{ $k->evaluasi_fisik ?? '-' }}

                        </span>

                    </td>

                    <td>

                        <span class="score-box">

                            {{ $k->evaluasi_mental ?? '-' }}

                        </span>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="6">

                        <div class="empty-state">

                            <div class="empty-icon">
                                📋
                            </div>

                            <div class="empty-text">

                                Belum ada riwayat latihan

                            </div>

                        </div>

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


<!-- BUTTON -->
<div class="mt-4">

    <a href="/pelatih/atlet"
       class="btn btn-back d-flex align-items-center gap-2 w-100 justify-content-center">

        Kembali

    </a>

</div>

@endsection