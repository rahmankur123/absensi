@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Tambah Prestasi</h4>
    <a href="/atlet/prestasi" class="btn btn-secondary">Kembali</a>
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

<form action="/atlet/prestasi/store" method="POST" enctype="multipart/form-data">
@csrf

<div class="card p-4 shadow-sm">

<div class="row">

    {{-- KIRI --}}
    <div class="col-md-6">

        <label>Nama Kejuaraan</label>
        <input type="text" name="nama_kejuaraan"
               value="{{ old('nama_kejuaraan') }}"
               class="form-control mb-3">

        <label>Tingkat</label>
        <select name="tingkat" class="form-control mb-3">
            <option value="">Pilih Tingkat</option>
            @foreach(['Kab/Kota','Provinsi','Nasional'] as $t)
                <option value="{{ $t }}"
                    {{ old('tingkat') == $t ? 'selected' : '' }}>
                    {{ $t }}
                </option>
            @endforeach
        </select>

        <label>Juara</label>
        <input type="text" name="juara"
               value="{{ old('juara') }}"
               placeholder="Contoh: 1 / 2 / 3"
               class="form-control mb-3">

    </div>

    {{-- KANAN --}}
    <div class="col-md-6">

        <label>Tahun</label>
        <input type="number" name="tahun"
               value="{{ old('tahun') }}"
               class="form-control mb-3">

        <label>Keterangan</label>
        <textarea name="keterangan"
                  class="form-control mb-3">{{ old('keterangan') }}</textarea>

    </div>

</div>

{{-- UPLOAD --}}
<div class="text-center mt-3">

    <label>Bukti Prestasi</label><br>

    <div id="previewBox" class="mb-2 text-muted">
        Belum ada file dipilih
    </div>

    <input type="file" name="bukti_prestasi" id="fileInput"
           class="form-control w-50 mx-auto">

</div>

{{-- BUTTON --}}
<div class="text-end mt-4">
    <button class="btn btn-success">Simpan</button>
</div>

</div>

</form>

{{-- SCRIPT PREVIEW --}}
<script>
document.getElementById('fileInput').addEventListener('change', function(e){
    const file = e.target.files[0];
    const preview = document.getElementById('previewBox');

    if(file){
        if(file.type.startsWith('image/')){
            const reader = new FileReader();
            reader.onload = function(e){
                preview.innerHTML = `<img src="${e.target.result}" width="120" class="rounded">`;
            }
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = file.name;
        }
    }
});
</script>

@endsection