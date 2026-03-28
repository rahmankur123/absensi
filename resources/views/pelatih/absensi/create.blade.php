@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Buat Absensi</h4>
    <a href="/pelatih/absensi" class="btn btn-secondary">Kembali</a>
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

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<form action="/pelatih/absensi/store" method="POST">
@csrf

<div class="card p-4 shadow-sm">

<div class="row">

    {{-- JADWAL --}}
    <div class="col-md-6">
        <label>Jadwal</label>
        <select name="jadwal_id" class="form-control mb-3" required>
            <option value="">-- Pilih Jadwal --</option>

            @foreach($jadwal as $j)
                <option value="{{ $j->id }}"
                    {{ old('jadwal_id') == $j->id ? 'selected' : '' }}>
                    
                    {{ ucfirst($j->hari) }} 
                    (
                    {{ \Carbon\Carbon::parse($j->jam_mulai)->format('H.i') }}
                    -
                    {{ \Carbon\Carbon::parse($j->jam_selesai)->format('H.i') }}
                    )

                </option>
            @endforeach
        </select>
    </div>

    {{-- TANGGAL --}}
    <div class="col-md-6">
        <label>Tanggal</label>
        <input type="date" 
               name="tanggal"
               value="{{ old('tanggal') }}"
               class="form-control mb-3"
               required>
    </div>

</div>

{{-- INFO --}}
<div class="alert alert-info">
    Absensi yang dibuat akan otomatis menampilkan seluruh atlet.
</div>

{{-- BUTTON --}}
<div class="text-end mt-3">
    <button class="btn btn-success">Buat Absensi</button>
</div>

</div>

</form>

@endsection