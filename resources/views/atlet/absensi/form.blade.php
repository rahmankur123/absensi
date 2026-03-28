@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Isi Absensi</h4>
    <a href="/atlet/absensi" class="btn btn-secondary">Kembali</a>
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

<form action="/atlet/absensi/{{ $data->id }}" 
      method="POST" 
      enctype="multipart/form-data">
@csrf

<div class="card p-4 shadow-sm">

    {{-- INFO LATIHAN --}}
    <div class="mb-3">
        <h5 class="mb-1">
            {{ ucfirst($data->absensi->jadwal->hari) }}
        </h5>

        <div class="text-muted">
            {{ \Carbon\Carbon::parse($data->absensi->tanggal)->translatedFormat('d F Y') }}
        </div>

        <div class="text-muted">
            {{ \Carbon\Carbon::parse($data->absensi->jadwal->jam_mulai)->format('H.i') }}
            -
            {{ \Carbon\Carbon::parse($data->absensi->jadwal->jam_selesai)->format('H.i') }}
        </div>
    </div>

    <hr>

    {{-- STATUS --}}
    <div class="mb-3">
        <label>Status Kehadiran</label>
        <select name="status" id="status" class="form-control">
            <option value="hadir">Hadir</option>
            <option value="izin">Izin</option>
        </select>
    </div>

    {{-- UPLOAD --}}
    <div class="mb-3" id="buktiBox">
        <label>Bukti</label>

        <div id="previewBox" class="mb-2 text-muted">
            Belum ada file dipilih
        </div>

        <input type="file" name="bukti" id="fileInput" class="form-control">
    </div>

    {{-- BUTTON --}}
    <div class="mt-3">
        <button class="btn btn-success">Submit</button>
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
    } else {
        buktiBox.style.display = 'block'; // tetap tampil untuk izin
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