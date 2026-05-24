@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">

    <h4>Tambah Prestasi</h4>

    <a href="/atlet/prestasi" class="btn btn-secondary">
        Kembali
    </a>

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

<form action="/atlet/prestasi/store"
      method="POST"
      enctype="multipart/form-data">

@csrf

<div class="card p-4 shadow-sm">

    <div class="row">

        {{-- KIRI --}}
        <div class="col-md-6">

            {{-- NAMA KEJUARAAN --}}
            <div class="mb-3">

                <label class="form-label">
                    Nama Kejuaraan
                </label>

                <input type="text"
                       name="nama_kejuaraan"
                       value="{{ old('nama_kejuaraan') }}"
                       class="form-control"
                       placeholder="Masukkan nama kejuaraan"
                       required>

            </div>

            {{-- TINGKAT --}}
            <div class="mb-3">

                <label class="form-label">
                    Tingkat
                </label>

                <select name="tingkat"
                        class="form-control"
                        required>

                    <option value="">
                        -- Pilih Tingkat --
                    </option>

                    @foreach(['Kab/Kota','Provinsi','Nasional'] as $t)

                        <option value="{{ $t }}"
                            {{ old('tingkat') == $t ? 'selected' : '' }}>

                            {{ $t }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- JUARA --}}
            <div class="mb-3">

                <label class="form-label">
                    Juara
                </label>

                <input type="text"
                       name="juara"
                       value="{{ old('juara') }}"
                       class="form-control"
                       placeholder="Contoh: Juara 1"
                       required>

            </div>

        </div>

        {{-- KANAN --}}
        <div class="col-md-6">

            {{-- TAHUN --}}
            <div class="mb-3">

                <label class="form-label">
                    Tahun
                </label>

                <input type="number"
                       name="tahun"
                       value="{{ old('tahun') }}"
                       class="form-control"
                       placeholder="Contoh: 2025"
                       required>

            </div>

            {{-- KETERANGAN --}}
            <div class="mb-3">

                <label class="form-label">
                    Keterangan
                </label>

                <textarea name="keterangan"
                          rows="5"
                          class="form-control"
                          placeholder="Tambahkan keterangan prestasi...">{{ old('keterangan') }}</textarea>

            </div>

        </div>

    </div>

    {{-- UPLOAD --}}
    <div class="mt-3">

        <label class="form-label">
            Bukti Prestasi
        </label>

        <div class="text-center border rounded p-4 bg-light">

            <div id="previewBox" class="mb-3 text-muted">

                <div style="font-size:40px;">🏆</div>

                <div class="mt-2">
                    Belum ada file dipilih
                </div>

            </div>

            <input type="file"
                   name="bukti_prestasi"
                   id="fileInput"
                   class="form-control"
                   accept="image/*,.pdf">

            <small class="text-muted">
                Upload gambar atau PDF bukti prestasi
            </small>

        </div>

    </div>

    {{-- BUTTON --}}
    <div class="text-end mt-4">

        <button class="btn btn-success">
            Simpan Prestasi
        </button>

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

                preview.innerHTML = `
                    <img src="${e.target.result}"
                         class="img-fluid rounded shadow-sm"
                         style="max-height:200px;">
                    <div class="mt-2 text-dark">
                        ${file.name}
                    </div>
                `;

            }

            reader.readAsDataURL(file);

        } else {

            preview.innerHTML = `
                <div style="font-size:50px;">📄</div>
                <div class="mt-2 text-dark">
                    ${file.name}
                </div>
            `;

        }

    }

});

</script>

@endsection