@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Tambah Atlet</h4>
    <a href="/admin/atlet" class="btn btn-secondary">Kembali</a>
</div>

{{-- ERROR --}}
@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="/admin/atlet/store" method="POST" enctype="multipart/form-data">
@csrf

<div class="card p-4 shadow-sm">

<div class="row">

    {{-- KOLOM KIRI (USER) --}}
    <div class="col-md-6">

        <h6 class="mb-3">Data Akun</h6>

        <label>Nama</label>
        <input type="text" name="nama" value="{{ old('nama') }}" class="form-control mb-2">

        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="form-control mb-2">

        <label>No HP</label>
        <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="form-control mb-2">

        <label>Password</label>
        <input type="password" name="password" class="form-control mb-2">

        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" class="form-control mb-2">

    </div>

    {{-- KOLOM KANAN (ATLET) --}}
    <div class="col-md-6">

        <h6 class="mb-3">Data Atlet</h6>

        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control mb-2">

        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" class="form-control mb-2">
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki'?'selected':'' }}>Laki-laki</option>
            <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan'?'selected':'' }}>Perempuan</option>
        </select>

        <label>Berat Badan (kg)</label>
        <input type="text" name="berat_badan" value="{{ old('berat_badan') }}" class="form-control mb-2">

        <label>Tinggi Badan (cm)</label>
        <input type="text" name="tinggi_badan" value="{{ old('tinggi_badan') }}" class="form-control mb-2">

        <label>Alamat</label>
        <textarea name="alamat" class="form-control mb-2">{{ old('alamat') }}</textarea>

    </div>

</div>

{{-- FOTO --}}
<div class="text-center mt-3">

    <label>Foto Atlet</label><br>

    <img id="previewFoto"
         src="https://via.placeholder.com/120"
         class="rounded-circle mb-2"
         width="120"
         height="120"
         style="object-fit:cover;">

    <input type="file" name="foto" id="foto" class="form-control w-25 mx-auto">

</div>

{{-- BUTTON --}}
<div class="text-end mt-4">
    <button class="btn btn-success">Simpan</button>
</div>

</div>

</form>

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