@extends('layouts.app')

@section('content')

<h4 class="mb-4">Edit Atlet</h4>

<form action="/admin/atlet/update/{{ $data->id }}" method="POST" enctype="multipart/form-data">
@csrf

{{-- FOTO TENGAH --}}
<div class="text-center mb-4">

    <div class="profile-img-wrapper mx-auto">

        <img id="previewFoto"
             src="{{ $data->user->foto ? asset('storage/'.$data->user->foto) : 'https://via.placeholder.com/150' }}"
             class="profile-img">

        <div class="overlay">
            <label for="foto" class="edit-text">Ubah Foto</label>
        </div>

        <input type="file" name="foto" id="foto" hidden>

    </div>

</div>

{{-- FORM --}}
<div class="card p-4">

<div class="row">

    {{-- KOLOM KIRI --}}
    <div class="col-md-6">

        <label>Nama</label>
        <input type="text" name="nama" value="{{ $data->user->nama }}" class="form-control mb-2">

        <label>Email</label>
        <input type="email" name="email" value="{{ $data->user->email }}" class="form-control mb-2">

        <label>No HP</label>
        <input type="text" name="no_hp" value="{{ $data->user->no_hp }}" class="form-control mb-2">

        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control mb-2">
            <option value="Laki-laki" {{ $data->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
            <option value="Perempuan" {{ $data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
        </select>

        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ $data->tanggal_lahir }}" class="form-control mb-2">

    </div>

    {{-- KOLOM KANAN --}}
    <div class="col-md-6">

        <label>Berat Badan (kg)</label>
        <input type="text" name="berat_badan" value="{{ $data->berat_badan }}" class="form-control mb-2">

        <label>Tinggi Badan (cm)</label>
        <input type="text" name="tinggi_badan" value="{{ $data->tinggi_badan }}" class="form-control mb-2">

        <label>Alamat</label>
        <textarea name="alamat" class="form-control mb-2">{{ $data->alamat }}</textarea>

        <select name="sabuk" class="form-control mb-2">
            @foreach(['Putih','Kuning','Hijau','Biru','Coklat','Hitam'] as $s)
                <option value="{{ $s }}" 
                    {{ $data->sabuk == $s ? 'selected' : '' }}>
                    {{ $s }}
                </option>
            @endforeach
        </select>

    </div>

</div>

{{-- BUTTON --}}
<div class="text-end mt-3">
    <button class="btn btn-success">Update</button>
    <a href="/admin/atlet" class="btn btn-secondary">Kembali</a>
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
document.getElementById('foto').addEventListener('change', function(e){
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