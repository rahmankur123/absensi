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

    .form-card{

        background:white;

        border:none;

        border-radius:28px;

        padding:35px;

        box-shadow:
            0 10px 35px rgba(15,23,42,0.05);
    }

    /* SECTION */

    .section-title{

        font-size:16px;
        font-weight:700;

        color:#0f172a;

        margin-bottom:20px;
    }

    /* FORM */

    .form-label{

        font-size:14px;
        font-weight:600;

        color:#334155;

        margin-bottom:8px;
    }

    .form-control,
    .form-select{

        height:52px;

        border:none;

        border-radius:16px;

        background:#f8fafc;

        padding:0 18px;

        font-size:14px;

        transition:0.2s;
    }

    textarea.form-control{
        min-height:120px;
        padding-top:14px;
    }

    .form-control:focus,
    .form-select:focus{

        background:white;

        border:none;

        box-shadow:
            0 0 0 4px rgba(14,165,233,0.12);
    }

    /* PHOTO */

    .photo-wrapper{

        display:flex;
        flex-direction:column;
        align-items:center;

        margin-top:25px;
    }

    .photo-box{

        position:relative;

        width:150px;
        height:150px;

        border-radius:30px;

        overflow:hidden;

        cursor:pointer;

        box-shadow:
            0 10px 25px rgba(15,23,42,0.08);
    }

    .photo-box img{

        width:100%;
        height:100%;

        object-fit:cover;
    }

    .photo-overlay{

        position:absolute;

        inset:0;

        background:rgba(15,23,42,0.55);

        display:flex;
        align-items:center;
        justify-content:center;

        opacity:0;

        transition:0.3s;
    }

    .photo-box:hover .photo-overlay{
        opacity:1;
    }

    .photo-overlay span{

        color:white;

        font-size:14px;
        font-weight:600;
    }

    /* BUTTON */

    .btn-save{

        height:52px;

        border:none;

        border-radius:16px;

        padding:0 28px;

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

    .btn-save:hover{

        transform:translateY(-2px);

        color:white;
    }

    .btn-back{

        height:52px;

        border:none;

        border-radius:16px;

        padding:0 24px;

        background:#e2e8f0;

        color:#334155;

        font-weight:600;
    }

    .btn-back:hover{
        background:#cbd5e1;
    }

    /* ALERT */

    .custom-alert{

        background:#fee2e2;

        border:none;

        border-radius:18px;

        padding:18px 22px;

        color:#991b1b;

        margin-bottom:24px;
    }

    .custom-alert ul{
        margin:0;
        padding-left:18px;
    }

</style>


<!-- HEADER -->
<div class="page-header">

    <div class="page-title">

        <h3>
            Tambah Atlet
        </h3>

        <p>
            Tambahkan data atlet baru ke sistem BD Camp
        </p>

    </div>

    <a href="/admin/atlet"
       class="btn btn-back d-flex align-items-center gap-2">

        Kembali

    </a>

</div>


<!-- ERROR -->
@if ($errors->any())

<div class="custom-alert">

    <ul>

        @foreach ($errors->all() as $error)

            <li>{{ $error }}</li>

        @endforeach

    </ul>

</div>

@endif


<form action="/admin/atlet/store"
      method="POST"
      enctype="multipart/form-data">

@csrf


<div class="form-card">

    <div class="row g-5">

        <!-- LEFT -->
        <div class="col-md-6">

            <div class="section-title">
                Data Akun
            </div>


            <div class="mb-3">

                <label class="form-label">
                    Nama Lengkap
                </label>

                <input type="text"
                       name="nama"
                       value="{{ old('nama') }}"
                       class="form-control">

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Email
                </label>

                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="form-control">

            </div>


            <div class="mb-3">

                <label class="form-label">
                    No HP
                </label>

                <input type="text"
                       name="no_hp"
                       value="{{ old('no_hp') }}"
                       class="form-control">

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Password
                </label>

                <input type="password"
                       name="password"
                       class="form-control">

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Konfirmasi Password
                </label>

                <input type="password"
                       name="password_confirmation"
                       class="form-control">

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Tingkatan Sabuk
                </label>

                <select name="sabuk"
                        class="form-select">

                    <option value="">
                        Pilih Sabuk
                    </option>

                    <option>Putih</option>
                    <option>Kuning</option>
                    <option>Hijau</option>
                    <option>Biru</option>
                    <option>Coklat</option>
                    <option>Hitam</option>

                </select>

            </div>

        </div>


        <!-- RIGHT -->
        <div class="col-md-6">

            <div class="section-title">
                Data Atlet
            </div>


            <div class="mb-3">

                <label class="form-label">
                    Tanggal Lahir
                </label>

                <input type="date"
                       name="tanggal_lahir"
                       value="{{ old('tanggal_lahir') }}"
                       class="form-control">

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Jenis Kelamin
                </label>

                <select name="jenis_kelamin"
                        class="form-select">

                    <option value="">
                        Pilih Jenis Kelamin
                    </option>

                    <option value="Laki-laki"
                        {{ old('jenis_kelamin')=='Laki-laki'?'selected':'' }}>

                        Laki-laki

                    </option>

                    <option value="Perempuan"
                        {{ old('jenis_kelamin')=='Perempuan'?'selected':'' }}>

                        Perempuan

                    </option>

                </select>

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Berat Badan (kg)
                </label>

                <input type="text"
                       name="berat_badan"
                       value="{{ old('berat_badan') }}"
                       class="form-control">

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Tinggi Badan (cm)
                </label>

                <input type="text"
                       name="tinggi_badan"
                       value="{{ old('tinggi_badan') }}"
                       class="form-control">

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Alamat
                </label>

                <textarea name="alamat"
                          class="form-control">{{ old('alamat') }}</textarea>

            </div>


            <!-- PHOTO -->
            <div class="photo-wrapper">

                <label class="form-label mb-3">
                    Foto Atlet
                </label>

                <label for="foto" class="photo-box">

                    <img id="previewFoto"
                         src="https://via.placeholder.com/150">

                    <div class="photo-overlay">

                        <span>
                            Upload Foto
                        </span>

                    </div>

                </label>

                <input type="file"
                       name="foto"
                       id="foto"
                       hidden>

            </div>

        </div>

    </div>


    <!-- BUTTON -->
    <div class="d-flex justify-content-end mt-5">

        <button class="btn-save">

            Simpan Atlet

        </button>

    </div>

</div>

</form>


<!-- PREVIEW -->
<script>

document.getElementById('foto')
.addEventListener('change', function(e){

    const file = e.target.files[0];

    if(file){

        const reader = new FileReader();

        reader.onload = function(e){

            document.getElementById('previewFoto')
            .src = e.target.result;

        }

        reader.readAsDataURL(file);
    }

});

</script>

@endsection