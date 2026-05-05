@extends('layouts.app')

@section('content')

<h4 class="mb-4">Profil Saya</h4>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="/atlet/profil/update" method="POST" enctype="multipart/form-data">
@csrf

{{-- FOTO INSTAGRAM STYLE --}}
<div class="text-center mb-4">

    <div class="profile-img-wrapper mx-auto">

        <img id="previewFoto"
             src="{{ $user->foto ? asset('storage/'.$user->foto) : 'https://via.placeholder.com/150' }}"
             class="profile-img">

        @if($mode == 'edit')
        <div class="overlay">
            <label for="foto" class="edit-text">Ubah Foto</label>
        </div>
        <input type="file" name="foto" id="foto" hidden>
        @endif

    </div>

</div>

{{-- FORM --}}
<div class="card p-4">

<div class="row">

    <div class="col-md-6 mb-3">
        <label>Nama</label>
        @if($mode == 'edit')
            <input type="text" name="nama" value="{{ $user->nama }}" class="form-control">
        @else
            <div class="form-control bg-light">{{ $user->nama }}</div>
        @endif
    </div>

    <div class="col-md-6 mb-3">
        <label>Email</label>
        @if($mode == 'edit')
            <input type="email" name="email" value="{{ $user->email }}" class="form-control">
        @else
            <div class="form-control bg-light">{{ $user->email }}</div>
        @endif
    </div>

    <div class="col-md-6 mb-3">
        <label>No HP</label>
        @if($mode == 'edit')
            <input type="text" name="no_hp" value="{{ $user->no_hp }}" class="form-control">
        @else
            <div class="form-control bg-light">{{ $user->no_hp }}</div>
        @endif
    </div>

    <div class="col-md-6 mb-3">
        <label>Tanggal Lahir</label>
        @if($mode == 'edit')
            <input type="date" name="tanggal_lahir" value="{{ $atlet->tanggal_lahir }}" class="form-control">
        @else
            <div class="form-control bg-light">{{ $atlet->tanggal_lahir }}</div>
        @endif
    </div>

    <div class="col-md-6 mb-3">
        <label>Jenis Kelamin</label>
        @if($mode == 'edit')
            <select name="jenis_kelamin" class="form-control">
                <option value="Laki-laki" {{ $atlet->jenis_kelamin=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                <option value="Perempuan" {{ $atlet->jenis_kelamin=='Perempuan'?'selected':'' }}>Perempuan</option>
            </select>
        @else
            <div class="form-control bg-light">{{ $atlet->jenis_kelamin }}</div>
        @endif
    </div>

    <div class="col-md-3 mb-3">
        <label>Berat</label>
        @if($mode == 'edit')
            <input type="text" name="berat_badan" value="{{ $atlet->berat_badan }}" class="form-control">
        @else
            <div class="form-control bg-light">{{ $atlet->berat_badan }}</div>
        @endif
    </div>

    <div class="col-md-3 mb-3">
        <label>Tinggi</label>
        @if($mode == 'edit')
            <input type="text" name="tinggi_badan" value="{{ $atlet->tinggi_badan }}" class="form-control">
        @else
            <div class="form-control bg-light">{{ $atlet->tinggi_badan }}</div>
        @endif
    </div>

    <div class="col-md-12 mb-3">
        <label>Alamat</label>
        @if($mode == 'edit')
            <textarea name="alamat" class="form-control">{{ $atlet->alamat }}</textarea>
        @else
            <div class="form-control bg-light">{{ $atlet->alamat }}</div>
        @endif
    </div>

    <div class="col-md-12 mb-3">
        <label>Sabuk</label>
        @if($mode == 'edit')
            <select name="sabuk" class="form-control">
                <option value="Putih" {{ $atlet->sabuk=='Putih'?'selected':'' }}>Putih</option>
                <option value="Kuning" {{ $atlet->sabuk=='Kuning'?'selected':'' }}>Kuning</option>
                <option value="Hijau" {{ $atlet->sabuk=='Hijau'?'selected':'' }}>Hijau</option>
                <option value="Biru" {{ $atlet->sabuk=='Biru'?'selected':'' }}>Biru</option>
                <option value="Coklat" {{ $atlet->sabuk=='Coklat'?'selected':'' }}>Coklat</option>
                <option value="Hitam" {{ $atlet->sabuk=='Hitam'?'selected':'' }}>Hitam</option>
            </select>
        @else
            <div class="form-control bg-light">{{ $atlet->sabuk }}</div>
        @endif
    </div>

</div>

<div class="text-end">
    @if($mode == 'view')
        <a href="/atlet/profil?mode=edit" class="btn btn-warning">Edit Profil</a>
    @endif

    @if($mode == 'edit')
        <a href="/atlet/profil" class="btn btn-secondary">Batal</a>
        <button class="btn btn-primary">Update</button>
    @endif
</div>

</div>

</form>

{{-- STYLE --}}
<style>
.profile-img-wrapper {
    position: relative;
    width: 150px;
    height: 150px;
    cursor: pointer;
}

.profile-img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #ddd;
    transition: 0.3s;
}

.overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 150px;
    height: 150px;
    background: rgba(0,0,0,0.5);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: 0.3s;
}

.profile-img-wrapper:hover .overlay {
    opacity: 1;
}

.edit-text {
    color: white;
    font-size: 14px;
    cursor: pointer;
}
</style>

{{-- SCRIPT PREVIEW --}}
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