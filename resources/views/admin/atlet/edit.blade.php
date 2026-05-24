@extends('layouts.app')

@section('content')

<style>

    .page-header{
        margin-bottom:30px;
    }

    .page-header h3{
        font-weight:700;
        color:#0f172a;
        margin-bottom:5px;
    }

    .page-header p{
        color:#64748b;
        margin:0;
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

    /* PHOTO */

    .profile-wrapper{
        display:flex;
        justify-content:center;
        margin-bottom:35px;
    }

    .profile-img-wrapper{

        position:relative;

        width:170px;
        height:170px;

        cursor:pointer;
    }

    .profile-img{

        width:170px;
        height:170px;

        border-radius:30px;

        object-fit:cover;

        border:5px solid white;

        box-shadow:
            0 15px 35px rgba(15,23,42,0.12);

        transition:0.3s;
    }

    .overlay{

        position:absolute;

        inset:0;

        background:rgba(15,23,42,0.55);

        border-radius:30px;

        display:flex;
        align-items:center;
        justify-content:center;

        opacity:0;

        transition:0.3s;
    }

    .profile-img-wrapper:hover .overlay{
        opacity:1;
    }

    .edit-text{

        color:white;

        font-size:14px;
        font-weight:600;

        cursor:pointer;
    }

    /* FORM */

    .section-title{

        font-size:15px;
        font-weight:700;

        color:#0f172a;

        margin-bottom:18px;
    }

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

        box-shadow:
            0 0 0 4px rgba(14,165,233,0.12);

        border:none;
    }

    /* BUTTON */

    .btn-update{

        height:50px;

        border:none;

        border-radius:16px;

        padding:0 26px;

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

    .btn-update:hover{
        transform:translateY(-2px);
    }

    .btn-back{

        height:50px;

        border:none;

        border-radius:16px;

        padding:0 22px;

        background:#e2e8f0;

        color:#334155;

        font-weight:600;
    }

    .btn-back:hover{
        background:#cbd5e1;
    }

</style>


<!-- HEADER -->
<div class="page-header">

    <h3>
        Edit Atlet
    </h3>

    <p>
        Perbarui data profil atlet BD Camp
    </p>

</div>


<form action="/admin/atlet/update/{{ $data->id }}"
      method="POST"
      enctype="multipart/form-data">

    @csrf


    <div class="form-card">

        <!-- PHOTO -->
        <div class="profile-wrapper">

            <div class="profile-img-wrapper">

                <img id="previewFoto"

                     src="{{ $data->user->foto ? asset('storage/'.$data->user->foto) : 'https://via.placeholder.com/170' }}"

                     class="profile-img">

                <div class="overlay">

                    <label for="foto"
                           class="edit-text">

                        Ubah Foto

                    </label>

                </div>

                <input type="file"
                       name="foto"
                       id="foto"
                       hidden>

            </div>

        </div>


        <div class="row g-4">

            <!-- LEFT -->
            <div class="col-md-6">

                <div class="section-title">
                    Informasi Pribadi
                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Nama Lengkap
                    </label>

                    <input type="text"
                           name="nama"
                           value="{{ $data->user->nama }}"
                           class="form-control">

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Email
                    </label>

                    <input type="email"
                           name="email"
                           value="{{ $data->user->email }}"
                           class="form-control">

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        No HP
                    </label>

                    <input type="text"
                           name="no_hp"
                           value="{{ $data->user->no_hp }}"
                           class="form-control">

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Jenis Kelamin
                    </label>

                    <select name="jenis_kelamin"
                            class="form-select">

                        <option value="Laki-laki"
                            {{ $data->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>
                            Laki-laki
                        </option>

                        <option value="Perempuan"
                            {{ $data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>
                            Perempuan
                        </option>

                    </select>

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Tanggal Lahir
                    </label>

                    <input type="date"
                           name="tanggal_lahir"
                           value="{{ $data->tanggal_lahir }}"
                           class="form-control">

                </div>

            </div>


            <!-- RIGHT -->
            <div class="col-md-6">

                <div class="section-title">
                    Informasi Atlet
                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Berat Badan (kg)
                    </label>

                    <input type="text"
                           name="berat_badan"
                           value="{{ $data->berat_badan }}"
                           class="form-control">

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Tinggi Badan (cm)
                    </label>

                    <input type="text"
                           name="tinggi_badan"
                           value="{{ $data->tinggi_badan }}"
                           class="form-control">

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Tingkatan Sabuk
                    </label>

                    <select name="sabuk"
                            class="form-select">

                        @foreach(['Putih','Kuning','Hijau','Biru','Coklat','Hitam'] as $s)

                            <option value="{{ $s }}"
                                {{ $data->sabuk == $s ? 'selected' : '' }}>

                                {{ $s }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <div class="mb-3">

                    <label class="form-label">
                        Alamat
                    </label>

                    <textarea name="alamat"
                              class="form-control">{{ $data->alamat }}</textarea>

                </div>

            </div>

        </div>


        <!-- BUTTON -->
        <div class="d-flex justify-content-end gap-3 mt-4">

            <a href="/admin/atlet"
               class="btn btn-back d-flex align-items-center gap-2">
                Kembali
            </a>

            <button class="btn-update">

                Update Atlet

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