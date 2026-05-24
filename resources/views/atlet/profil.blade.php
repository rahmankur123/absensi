@extends('layouts.app')

@section('content')

<style>

    .profile-header{
        margin-bottom:30px;
    }

    .profile-header h3{
        font-weight:700;
        color:#0f172a;
        margin-bottom:4px;
    }

    .profile-header p{
        color:#64748b;
        margin:0;
    }

    .profile-card{

        background:white;

        border:none;

        border-radius:24px;

        padding:30px;

        box-shadow:
            0 4px 20px rgba(15,23,42,0.05);
    }

    /* FOTO */

    .profile-img-wrapper{

        position:relative;

        width:170px;
        height:170px;

        margin:auto;

        cursor:pointer;
    }

    .profile-img{

        width:170px;
        height:170px;

        border-radius:50%;

        object-fit:cover;

        border:5px solid #e2e8f0;

        transition:0.3s;
    }

    .overlay{

        position:absolute;

        top:0;
        left:0;

        width:170px;
        height:170px;

        border-radius:50%;

        background:rgba(15,23,42,0.55);

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

        text-decoration:none;
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

        border-radius:14px;

        border:1px solid #cbd5e1;

        padding:12px 14px;

        box-shadow:none !important;
    }

    .form-control:focus,
    .form-select:focus{

        border-color:#3b82f6;

        box-shadow:
            0 0 0 4px rgba(59,130,246,0.1) !important;
    }

    .profile-view{

        background:#f8fafc;

        border:1px solid #e2e8f0;

        border-radius:14px;

        padding:12px 14px;

        min-height:48px;

        color:#334155;
    }

    /* BUTTON */

    .btn-custom{

        padding:10px 18px;

        border-radius:14px;

        font-weight:600;

        text-decoration:none;
    }

</style>


<div class="profile-header">

    <h3>
        Profil Saya
    </h3>

    <p>
        Kelola data profil atlet BD Camp
    </p>

</div>


@if(session('success'))

<div class="alert alert-success border-0 shadow-sm">
    {{ session('success') }}
</div>

@endif


<form action="/atlet/profil/update"
      method="POST"
      enctype="multipart/form-data">

@csrf

<div class="profile-card">

    {{-- FOTO --}}
    <div class="text-center mb-5">

        <div class="profile-img-wrapper">

            <img id="previewFoto"
                 src="{{ $user->foto ? asset('storage/'.$user->foto) : 'https://via.placeholder.com/170' }}"
                 class="profile-img">

            @if($mode == 'edit')

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

            @endif

        </div>

    </div>


    <div class="row">

        {{-- NAMA --}}
        <div class="col-md-6 mb-4">

            <label class="form-label">
                Nama
            </label>

            @if($mode == 'edit')

                <input type="text"
                       name="nama"
                       value="{{ $user->nama }}"
                       class="form-control">

            @else

                <div class="profile-view">
                    {{ $user->nama }}
                </div>

            @endif

        </div>


        {{-- EMAIL --}}
        <div class="col-md-6 mb-4">

            <label class="form-label">
                Email
            </label>

            @if($mode == 'edit')

                <input type="email"
                       name="email"
                       value="{{ $user->email }}"
                       class="form-control">

            @else

                <div class="profile-view">
                    {{ $user->email }}
                </div>

            @endif

        </div>


        {{-- NO HP --}}
        <div class="col-md-6 mb-4">

            <label class="form-label">
                No HP
            </label>

            @if($mode == 'edit')

                <input type="text"
                       name="no_hp"
                       value="{{ $user->no_hp }}"
                       class="form-control">

            @else

                <div class="profile-view">
                    {{ $user->no_hp }}
                </div>

            @endif

        </div>


        {{-- TANGGAL LAHIR --}}
        <div class="col-md-6 mb-4">

            <label class="form-label">
                Tanggal Lahir
            </label>

            @if($mode == 'edit')

                <input type="date"
                       name="tanggal_lahir"
                       value="{{ $atlet->tanggal_lahir }}"
                       class="form-control">

            @else

                <div class="profile-view">
                    {{ $atlet->tanggal_lahir }}
                </div>

            @endif

        </div>


        {{-- JK --}}
        <div class="col-md-6 mb-4">

            <label class="form-label">
                Jenis Kelamin
            </label>

            @if($mode == 'edit')

                <select name="jenis_kelamin"
                        class="form-select">

                    <option value="Laki-laki"
                        {{ $atlet->jenis_kelamin=='Laki-laki'?'selected':'' }}>
                        Laki-laki
                    </option>

                    <option value="Perempuan"
                        {{ $atlet->jenis_kelamin=='Perempuan'?'selected':'' }}>
                        Perempuan
                    </option>

                </select>

            @else

                <div class="profile-view">
                    {{ $atlet->jenis_kelamin }}
                </div>

            @endif

        </div>


        {{-- SABUK --}}
        <div class="col-md-6 mb-4">

            <label class="form-label">
                Tingkatan Sabuk
            </label>

            @if($mode == 'edit')

                <select name="sabuk"
                        class="form-select">

                    <option value="Putih" {{ $atlet->sabuk=='Putih'?'selected':'' }}>Putih</option>
                    <option value="Kuning" {{ $atlet->sabuk=='Kuning'?'selected':'' }}>Kuning</option>
                    <option value="Hijau" {{ $atlet->sabuk=='Hijau'?'selected':'' }}>Hijau</option>
                    <option value="Biru" {{ $atlet->sabuk=='Biru'?'selected':'' }}>Biru</option>
                    <option value="Coklat" {{ $atlet->sabuk=='Coklat'?'selected':'' }}>Coklat</option>
                    <option value="Hitam" {{ $atlet->sabuk=='Hitam'?'selected':'' }}>Hitam</option>

                </select>

            @else

                <div class="profile-view">
                    {{ $atlet->sabuk }}
                </div>

            @endif

        </div>


        {{-- BERAT --}}
        <div class="col-md-3 mb-4">

            <label class="form-label">
                Berat Badan
            </label>

            @if($mode == 'edit')

                <input type="text"
                       name="berat_badan"
                       value="{{ $atlet->berat_badan }}"
                       class="form-control">

            @else

                <div class="profile-view">
                    {{ $atlet->berat_badan }} kg
                </div>

            @endif

        </div>


        {{-- TINGGI --}}
        <div class="col-md-3 mb-4">

            <label class="form-label">
                Tinggi Badan
            </label>

            @if($mode == 'edit')

                <input type="text"
                       name="tinggi_badan"
                       value="{{ $atlet->tinggi_badan }}"
                       class="form-control">

            @else

                <div class="profile-view">
                    {{ $atlet->tinggi_badan }} cm
                </div>

            @endif

        </div>


        {{-- ALAMAT --}}
        <div class="col-md-12 mb-4">

            <label class="form-label">
                Alamat
            </label>

            @if($mode == 'edit')

                <textarea name="alamat"
                          class="form-control"
                          rows="4">{{ $atlet->alamat }}</textarea>

            @else

                <div class="profile-view">
                    {{ $atlet->alamat }}
                </div>

            @endif

        </div>

    </div>


    {{-- BUTTON --}}
    <div class="text-end mt-2">

        @if($mode == 'view')

            <a href="/atlet/profil?mode=edit"
               class="btn btn-warning btn-custom">
                Edit Profil
            </a>

        @endif


        @if($mode == 'edit')

            <a href="/atlet/profil"
               class="btn btn-secondary btn-custom"
               style="text-decoration:none;">
                Batal
            </a>

            <button class="btn btn-primary btn-custom">
                Update Profil
            </button>

        @endif

    </div>

</div>

</form>


{{-- PREVIEW FOTO --}}
<script>

document.getElementById('foto')?.addEventListener('change', function(e){

    const file = e.target.files[0];

    if(file){

        const reader = new FileReader();

        reader.onload = function(e){

            document.getElementById('previewFoto').src = e.target.result;

        }

        reader.readAsDataURL(file);
    }

});

</script>

@endsection