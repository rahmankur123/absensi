@php
    $role = auth()->user()->role;
@endphp

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

    .sidebar{
        width:270px;
        height:100vh;

        position:fixed;
        left:0;
        top:0;

        background:
            linear-gradient(
                180deg,
                #0f172a 0%,
                #111827 100%
            );

        border-right:1px solid rgba(255,255,255,0.05);

        padding:20px 16px;

        overflow-y:auto;
    }

    .sidebar::-webkit-scrollbar{
        width:5px;
    }

    .sidebar::-webkit-scrollbar-thumb{
        background:#334155;
        border-radius:20px;
    }

    .sidebar-brand{
        display:flex;
        align-items:center;
        gap:14px;

        padding:10px 12px;
        margin-bottom:35px;
    }

    .sidebar-brand img{
        width:48px;
        height:48px;
        object-fit:cover;

        border-radius:14px;

        box-shadow:
            0 10px 20px rgba(56,189,248,0.25);
    }

    .brand-text{
        color:white;
    }

    .brand-text h5{
        margin:0;
        font-weight:700;
        font-size:18px;
    }

    .brand-text small{
        color:#94a3b8;
        font-size:12px;
    }

    .menu-title{
        color:#64748b;
        font-size:11px;
        font-weight:600;

        text-transform:uppercase;
        letter-spacing:1px;

        margin:
            25px 12px 12px;
    }

    .sidebar a{
        display:flex;
        align-items:center;
        gap:14px;

        padding:13px 16px;
        margin-bottom:8px;

        border-radius:14px;

        color:#cbd5e1;
        text-decoration:none;

        transition:all 0.25s ease;

        font-size:14px;
        font-weight:500;
    }

    .sidebar a i{
        width:18px;
        text-align:center;
        font-size:15px;
    }

    .sidebar a:hover{
        background:rgba(255,255,255,0.06);
        color:white;

        transform:translateX(3px);
    }

    .sidebar a.active{
        background:
            linear-gradient(
                135deg,
                #0ea5e9,
                #6366f1
            );

        color:white;

        box-shadow:
            0 10px 25px rgba(99,102,241,0.35);
    }

    .logout-btn{
        margin-top:30px !important;

        background:rgba(239,68,68,0.08);
        color:#fca5a5 !important;
    }

    .logout-btn:hover{
        background:#ef4444 !important;
        color:white !important;
    }

</style>

<div class="sidebar">

    <!-- BRAND -->
    <div class="sidebar-brand">

        <img src="{{ asset('logo.jpg') }}" alt="BD Camp">

        <div class="brand-text">
            <h5>BD Camp</h5>
            <small>Sistem Monitoring Atlet</small>
        </div>

    </div>

    <!-- ADMIN -->
    @if($role == 'admin')

        <div class="menu-title">
            Main Menu
        </div>

        <a href="/admin"
           class="{{ request()->is('admin') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <a href="/admin/atlet"
           class="{{ request()->is('admin/atlet*') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i>
            Data Atlet
        </a>

        <a href="/admin/jadwal"
           class="{{ request()->is('admin/jadwal*') ? 'active' : '' }}">
            <i class="fa-solid fa-calendar-days"></i>
            Jadwal Latihan
        </a>

        <a href="/admin/laporan"
           class="{{ request()->is('admin/laporan*') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-column"></i>
            Laporan Kehadiran
        </a>

        <a href="/admin/prestasi"
           class="{{ request()->is('admin/prestasi*') ? 'active' : '' }}">
            <i class="fa-solid fa-trophy"></i>
            Validasi Prestasi
        </a>

    @endif


    <!-- PELATIH -->
    @if($role == 'pelatih')

        <div class="menu-title">
            Pelatih Menu
        </div>

        <a href="/pelatih"
           class="{{ request()->is('pelatih') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <a href="/pelatih/atlet"
           class="{{ request()->is('pelatih/atlet*') ? 'active' : '' }}">
            <i class="fa-solid fa-users"></i>
            Data Atlet
        </a>

        <a href="/pelatih/absensi"
           class="{{ request()->is('pelatih/absensi*') ? 'active' : '' }}">
            <i class="fa-solid fa-clipboard-check"></i>
            Absensi
        </a>

        <a href="/pelatih/laporan"
           class="{{ request()->is('pelatih/laporan*') ? 'active' : '' }}">
            <i class="fa-solid fa-chart-line"></i>
            Laporan Kehadiran
        </a>

    @endif


    <!-- ATLET -->
    @if($role == 'atlet')

        <div class="menu-title">
            Atlet Menu
        </div>

        <a href="/atlet"
           class="{{ request()->is('atlet') ? 'active' : '' }}">
            <i class="fa-solid fa-house"></i>
            Dashboard
        </a>

        <a href="/atlet/profil"
           class="{{ request()->is('atlet/profil*') ? 'active' : '' }}">
            <i class="fa-solid fa-user"></i>
            Profil
        </a>

        <a href="/atlet/jadwal"
           class="{{ request()->is('atlet/jadwal*') ? 'active' : '' }}">
            <i class="fa-solid fa-calendar-days"></i>
            Jadwal
        </a>

        <a href="/atlet/absensi"
           class="{{ request()->is('atlet/absensi*') ? 'active' : '' }}">
            <i class="fa-solid fa-clipboard-check"></i>
            Absensi
        </a>

        <a href="/atlet/riwayat"
           class="{{ request()->is('atlet/riwayat*') ? 'active' : '' }}">
            <i class="fa-solid fa-clock-rotate-left"></i>
            Riwayat Kehadiran
        </a>

        <a href="/atlet/prestasi"
           class="{{ request()->is('atlet/prestasi*') ? 'active' : '' }}">
            <i class="fa-solid fa-medal"></i>
            Prestasi
        </a>

    @endif


    <!-- LOGOUT -->
    <a href="/logout" class="logout-btn">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
    </a>

</div>