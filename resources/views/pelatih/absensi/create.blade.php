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

        padding:32px;

        box-shadow:
            0 10px 35px rgba(15,23,42,0.05);
    }

    /* ALERT */

    .alert-custom{

        border:none;

        border-radius:18px;

        padding:18px 20px;

        margin-bottom:24px;

        font-weight:500;
    }

    .alert-error{

        background:#fee2e2;

        color:#991b1b;
    }

    .alert-info-custom{

        background:#eff6ff;

        color:#1d4ed8;
    }

    /* INPUT */

    .form-label{

        font-size:14px;

        font-weight:600;

        color:#334155;

        margin-bottom:10px;
    }

    .custom-input{

        height:56px;

        border:none;

        border-radius:18px;

        background:#f8fafc;

        padding:0 18px;

        color:#0f172a;

        transition:0.2s;
    }

    .custom-input:focus{

        background:white;

        outline:none;

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

    .btn-back{

        border:none;

        border-radius:16px;

        padding:12px 20px;

        background:#e2e8f0;

        color:#0f172a;

        font-weight:600;
    }

    .btn-submit{

        border:none;

        border-radius:18px;

        padding:14px 28px;

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

    .btn-submit:hover{

        transform:translateY(-2px);

        color:white;
    }

    /* INFO BOX */

    .info-box{

        display:flex;

        align-items:flex-start;

        gap:14px;

        background:#f8fafc;

        border-radius:20px;

        padding:20px;

        margin-top:10px;
    }

    .info-icon{

        width:42px;
        height:42px;

        border-radius:14px;

        display:flex;
        align-items:center;
        justify-content:center;

        background:#dbeafe;

        font-size:20px;
    }

    .info-content h6{

        font-weight:700;

        color:#0f172a;

        margin-bottom:4px;
    }

    .info-content p{

        margin:0;

        color:#64748b;

        font-size:14px;

        line-height:1.6;
    }

</style>


<!-- HEADER -->
<div class="page-header">

    <div class="page-title">

        <h3>
            Buat Absensi
        </h3>

        <p>
            Buat sesi absensi latihan untuk seluruh atlet
        </p>

    </div>

    <a href="/pelatih/absensi"
       class="btn-back">

        Kembali

    </a>

</div>


<!-- ERROR -->
@if ($errors->any())

<div class="alert-custom alert-error">

    <ul class="mb-0 ps-3">

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif


@if(session('error'))

<div class="alert-custom alert-error">

    {{ session('error') }}

</div>

@endif


<form action="/pelatih/absensi/store"
      method="POST">

@csrf


<div class="custom-card">

    <div class="row g-4">

        <!-- JADWAL -->
        <div class="col-md-6">

            <label class="form-label">

                Jadwal Latihan

            </label>

            <select name="jadwal_id"
                    class="custom-input w-100"
                    required>

                <option value="">
                    -- Pilih Jadwal --
                </option>

                @foreach($jadwal as $j)

                    <option value="{{ $j->id }}"
                        {{ old('jadwal_id') == $j->id ? 'selected' : '' }}>

                        {{ ucfirst($j->hari) }}

                        (
                        {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H.i') }}
                        -
                        {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H.i') }}
                        )

                    </option>

                @endforeach

            </select>

        </div>


        <!-- TANGGAL -->
        <div class="col-md-6">

            <label class="form-label">

                Tanggal Absensi

            </label>

            <input type="date"
                   name="tanggal"
                   value="{{ old('tanggal') }}"
                   class="custom-input w-100"
                   required>

        </div>

    </div>


    <!-- INFO -->
    <div class="info-box">

        <div class="info-icon">
            📋
        </div>

        <div class="info-content">

            <h6>
                Informasi Absensi
            </h6>

            <p>
                Absensi yang dibuat akan otomatis menampilkan seluruh atlet
                yang terdaftar untuk proses pencatatan kehadiran latihan.
            </p>

        </div>

    </div>


    <!-- BUTTON -->
    <div class="text-end mt-4">

        <button class="btn-submit">

            Buat Absensi

        </button>

    </div>

</div>

</form>

@endsection