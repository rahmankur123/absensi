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

    .form-label{
        font-weight:600;
        color:#334155;
        margin-bottom:8px;
    }

    .form-control,
    .form-select{
        border-radius:14px;
        border:1px solid #e2e8f0;
        padding:12px 14px;
        box-shadow:none !important;
    }

    .form-control:focus,
    .form-select:focus{
        border-color:#3b82f6;
    }

    .info-box{
        background:#eff6ff;
        border:none;
        border-radius:16px;
        color:#1e40af;
        padding:14px 18px;
    }

    .btn-custom{
        border-radius:14px;
        padding:10px 18px;
        font-weight:600;
    }

</style>

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center page-title">

    <h4>Edit Jadwal Latihan</h4>

    <a href="/admin/jadwal" class="btn btn-secondary btn-custom">
        Kembali
    </a>

</div>

{{-- ERROR --}}
@if ($errors->any())

<div class="alert alert-danger border-0 shadow-sm">

    <ul class="mb-0">

        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach

    </ul>

</div>

@endif

<form action="/admin/jadwal/update/{{ $data->id }}" method="POST">
@csrf

<div class="custom-card p-4">

    <div class="row g-4">

        {{-- HARI --}}
        <div class="col-md-4">

            <label class="form-label">
                Hari
            </label>

            <select name="hari" class="form-select">

                @foreach(['senin','selasa','rabu','kamis','jumat','sabtu','minggu'] as $h)

                    <option value="{{ $h }}"
                        {{ old('hari', $data->hari) == $h ? 'selected' : '' }}>

                        {{ ucfirst($h) }}

                    </option>

                @endforeach

            </select>

        </div>

        {{-- JAM MULAI --}}
        <div class="col-md-4">

            <label class="form-label">
                Jam Mulai
            </label>

            <input type="time"
                   name="jam_mulai"
                   value="{{ old('jam_mulai', $data->jam_mulai) }}"
                   class="form-control">

        </div>

        {{-- JAM SELESAI --}}
        <div class="col-md-4">

            <label class="form-label">
                Jam Selesai
            </label>

            <input type="time"
                   name="jam_selesai"
                   value="{{ old('jam_selesai', $data->jam_selesai) }}"
                   class="form-control">

        </div>

    </div>

    {{-- INFO --}}
    <div class="info-box mt-4">

        Pastikan jam selesai lebih besar dari jam mulai.

    </div>

    {{-- BUTTON --}}
    <div class="text-end mt-4">

        <button class="btn btn-success btn-custom">
            Update Jadwal
        </button>

    </div>

</div>

</form>

@endsection