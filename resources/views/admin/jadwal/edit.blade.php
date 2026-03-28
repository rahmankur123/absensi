@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Edit Jadwal Latihan</h4>
    <a href="/admin/jadwal" class="btn btn-secondary">Kembali</a>
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

<form action="/admin/jadwal/update/{{ $data->id }}" method="POST">
@csrf

<div class="card p-4 shadow-sm">

<div class="row">

    {{-- HARI --}}
    <div class="col-md-4">
        <label>Hari</label>
        <select name="hari" class="form-control mb-3">
            @foreach(['senin','selasa','rabu','kamis','jumat','sabtu','minggu'] as $h)
                <option value="{{ $h }}"
                    {{ old('hari', $data->hari) == $h ? 'selected' : '' }}>
                    {{ ucfirst($h) }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- JAM MULAI --}}
    <div class="col-md-4">
        <label>Jam Mulai</label>
        <input type="time"
               name="jam_mulai"
               value="{{ old('jam_mulai', $data->jam_mulai) }}"
               class="form-control mb-3">
    </div>

    {{-- JAM SELESAI --}}
    <div class="col-md-4">
        <label>Jam Selesai</label>
        <input type="time"
               name="jam_selesai"
               value="{{ old('jam_selesai', $data->jam_selesai) }}"
               class="form-control mb-3">
    </div>

</div>

{{-- INFO --}}
<div class="alert alert-info mt-2">
    Pastikan jam selesai lebih besar dari jam mulai.
</div>

{{-- BUTTON --}}
<div class="text-end mt-3">
    <button class="btn btn-success">Update</button>
</div>

</div>

</form>

@endsection