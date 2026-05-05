@php
    $role = auth()->user()->role; 
@endphp

<style>
    .sidebar a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 10px 20px;
        border-left: 4px solid transparent;
        transition: all 0.3s ease;
    }

    .sidebar a:hover {
        background: #334155;
    }

    .sidebar a.active {
        background: #76bbdb;
        border-left: 4px solid #38bdf8;
        font-weight: bold;
    }
</style>

<div class="sidebar">
    <div class="d-flex justify-content-center align-items-center gap-2 px-3 py-3">
    
    <img src="{{ asset('logo.jpg') }}" 
         alt="BD Camp"
         style="width:40px; height:40px; object-fit:cover;">

    <h5 class="mb-0 text-white fw-bold">BD Camp</h5>

</div>

    {{-- ADMIN --}}
    @if($role == 'admin')
        <a href="/admin" class="{{ request()->is('admin') ? 'active' : '' }}">Dashboard</a>
        <a href="/admin/atlet" class="{{ request()->is('admin/atlet*') ? 'active' : '' }}">Data Atlet</a>
        <a href="/admin/jadwal" class="{{ request()->is('admin/jadwal*') ? 'active' : '' }}">Jadwal Latihan</a>
        <a href="/admin/laporan" class="{{ request()->is('admin/laporan*') ? 'active' : '' }}">Laporan Kehadiran</a>
        <a href="/admin/prestasi" class="{{ request()->is('admin/prestasi*') ? 'active' : '' }}">Validasi Prestasi</a>
    @endif

    {{-- PELATIH --}}
    @if($role == 'pelatih')
        <a href="/pelatih" class="{{ request()->is('pelatih') ? 'active' : '' }}">Dashboard</a>
        <a href="/pelatih/atlet" class="{{ request()->is('pelatih/atlet*') ? 'active' : '' }}">Data Atlet</a>
        <a href="/pelatih/absensi" class="{{ request()->is('pelatih/absensi*') ? 'active' : '' }}">Absensi</a>
        <a href="/pelatih/laporan" class="{{ request()->is('pelatih/laporan*') ? 'active' : '' }}">Laporan Kehadiran</a>
    @endif

    {{-- ATLET --}}
    @if($role == 'atlet')
        <a href="/atlet" class="{{ request()->is('atlet') ? 'active' : '' }}">Dashboard</a>
        <a href="/atlet/profil" class="{{ request()->is('atlet/profil*') ? 'active' : '' }}">Profil</a>
        <a href="/atlet/jadwal" class="{{ request()->is('atlet/jadwal*') ? 'active' : '' }}">Jadwal</a>
        <a href="/atlet/absensi" class="{{ request()->is('atlet/absensi*') ? 'active' : '' }}">Absensi</a>
        <a href="/atlet/riwayat" class="{{ request()->is('atlet/riwayat*') ? 'active' : '' }}">Riwayat Kehadiran</a>
        <a href="/atlet/prestasi" class="{{ request()->is('atlet/prestasi*') ? 'active' : '' }}">Prestasi</a>
    @endif

    <hr>

    <a href="/logout">Logout</a>
</div>