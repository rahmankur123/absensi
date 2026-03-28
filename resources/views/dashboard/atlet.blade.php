@extends('layouts.app')

@section('content')

<h4 class="mb-4">Dashboard Atlet</h4>

<div class="row mb-4">

    <div class="col-md-3">
        <div class="card text-white shadow" style="background:#3b82f6">
            <div class="card-body">
                <h6>Total Latihan</h6>
                <h3>{{ $totalLatihan }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white shadow" style="background:#10b981">
            <div class="card-body">
                <h6>Hadir</h6>
                <h3>{{ $hadir }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white shadow" style="background:#f59e0b">
            <div class="card-body">
                <h6>Izin</h6>
                <h3>{{ $izin }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white shadow" style="background:#ef4444">
            <div class="card-body">
                <h6>Prestasi</h6>
                <h3>{{ $prestasi }}</h3>
            </div>
        </div>
    </div>

</div>

{{-- PROGRESS --}}
@php
$total = $totalLatihan;
$persen = $total ? ($hadir / $total) * 100 : 0;
@endphp

<div class="card p-3 mb-4 shadow">
    <h6>Progress Kehadiran</h6>

    <div class="progress" style="height:25px;">
        <div class="progress-bar bg-success" style="width: {{ $persen }}%">
            {{ round($persen) }}%
        </div>
    </div>
</div>

{{-- RIWAYAT --}}
<div class="card p-3 shadow">
    <h6>Latihan Terakhir</h6>

    <table class="table">
        @foreach($recent as $r)
        <tr>
            <td>{{ $r->absensi->tanggal }}</td>
            <td>{{ $r->status }}</td>
        </tr>
        @endforeach
    </table>
</div>

@endsection