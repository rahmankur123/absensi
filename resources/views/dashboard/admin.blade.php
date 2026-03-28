@extends('layouts.app')

@section('content')

<h4 class="mb-4">Selamat Datang, {{ Auth::user()->nama }}</h4>

{{-- CARD STAT --}}
<div class="row mb-4">

    <div class="col-md-3">
        <div class="card shadow text-white" style="background: linear-gradient(45deg,#3b82f6,#60a5fa)">
            <div class="card-body">
                <h6>Total Atlet</h6>
                <h3>{{ $totalAtlet }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow text-white" style="background: linear-gradient(45deg,#10b981,#34d399)">
            <div class="card-body">
                <h6>Total Latihan</h6>
                <h3>{{ $totalLatihan }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow text-white" style="background: linear-gradient(45deg,#f59e0b,#fbbf24)">
            <div class="card-body">
                <h6>Kehadiran Bulan Ini</h6>
                <h3>{{ $hadir }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card shadow text-white" style="background: linear-gradient(45deg,#ef4444,#f87171)">
            <div class="card-body">
                <h6>Prestasi</h6>
                <h3>{{ $totalPrestasi }}</h3>
            </div>
        </div>
    </div>

</div>

{{-- CHART / PROGRESS --}}
<div class="row mb-4">

    <div class="col-md-6">
        <div class="card p-3 shadow" style="height: 130px;">
            <h6>Kehadiran vs Tidak Hadir</h6>

            @php
                $total = $hadir + $tidak;
                $persen = $total ? ($hadir / $total) * 100 : 0;
            @endphp

            <div class="progress" style="height:25px;">
                <div class="progress-bar bg-success" style="width: {{ $persen }}%">
                    {{ round($persen) }}%
                </div>
            </div>

            <small class="text-muted mt-2 d-block">
                {{ $hadir }} hadir dari {{ $total }} total
            </small>
        </div>
    </div>

    {{-- INFO --}}
    <div class="col-md-6">
        <div class="card p-3 shadow h-40" style="height: 130px;">
            <h6>Insight</h6>

            <ul>
                <li>Total atlet aktif: <b>{{ $totalAtlet }}</b></li>
                <li>Latihan berjalan: <b>{{ $totalLatihan }}</b></li>
                <li>Prestasi tercatat: <b>{{ $totalPrestasi }}</b></li>
            </ul>
        </div>
    </div>

</div>

{{-- AKTIVITAS --}}
<div class="card p-3 shadow">
    <h6>Aktivitas Terbaru</h6>

    <table class="table">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Jadwal</th>
            </tr>
        </thead>

        <tbody>
            @forelse($recentAbsensi as $a)
            <tr>
                <td>{{ $a->tanggal }}</td>
                <td>
                    {{ ucfirst($a->jadwal->hari) }}
                    ({{ $a->jadwal->jam_mulai }} - {{ $a->jadwal->jam_selesai }})
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="2" class="text-center text-muted">
                    Belum ada aktivitas
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection