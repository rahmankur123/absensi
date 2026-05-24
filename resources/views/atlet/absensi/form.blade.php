@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">

    <div>
        <h4 class="mb-1">Isi Absensi</h4>

        <small class="text-muted">
            Silakan isi kehadiran latihan
        </small>
    </div>

    <a href="/atlet/absensi" class="btn btn-secondary">
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

{{-- ERROR SESSION --}}
@if(session('error'))

<div class="alert alert-danger">
    {{ session('error') }}
</div>

@endif

<form action="/atlet/absensi/{{ $data->id }}"
      method="POST"
      enctype="multipart/form-data">

@csrf

<div class="card p-4 shadow-sm">

    {{-- INFO LATIHAN --}}
    <div class="mb-4">

        <div class="border rounded p-3 bg-light">

            <h5 class="mb-2">

                {{ ucfirst($data->absensi->jadwal->hari) }}

            </h5>

            <div class="text-muted mb-1">

                📅
                {{ \Carbon\Carbon::parse($data->absensi->tanggal)->translatedFormat('d F Y') }}

            </div>

            <div class="text-muted">

                ⏰
                {{ \Carbon\Carbon::parse($data->absensi->jadwal->jam_mulai)->format('H.i') }}
                -
                {{ \Carbon\Carbon::parse($data->absensi->jadwal->jam_selesai)->format('H.i') }}

            </div>

        </div>

    </div>

    {{-- STATUS --}}
    <div class="mb-3">

        <label class="form-label">
            Status Kehadiran
        </label>

        <select name="status"
                id="status"
                class="form-control"
                required>

            <option value="hadir">
                Hadir
            </option>

            <option value="izin">
                Izin
            </option>

        </select>

    </div>

    {{-- BUKTI --}}
    <div class="mb-3" id="buktiBox">

        <label class="form-label">
            Bukti Kehadiran / Izin
        </label>

        <div class="border rounded p-4 bg-light text-center">

            <div id="previewBox" class="mb-3 text-muted">

                <div style="font-size:40px;">📁</div>

                <div class="mt-2">
                    Belum ada file dipilih
                </div>

            </div>

            <input type="file"
                   name="bukti"
                   id="fileInput"
                   class="form-control"
                   accept="image/*,.pdf">

            <small class="text-muted">
                Upload gambar atau PDF
            </small>

        </div>

    </div>

    {{-- BUTTON --}}
    <div class="text-end mt-4">

        <button class="btn btn-success">

            Submit Absensi

        </button>

    </div>

</div>

</form>

{{-- SCRIPT --}}
<script>

const status = document.getElementById('status');
const buktiBox = document.getElementById('buktiBox');

status.addEventListener('change', function(){

    if(this.value === 'hadir'){

        buktiBox.style.display = 'block';

    }else{

        buktiBox.style.display = 'block';

    }

});

// PREVIEW FILE
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