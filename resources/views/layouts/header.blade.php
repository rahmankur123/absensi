<div class="bg-white shadow-sm px-4 py-3 d-flex justify-content-between align-items-center">

    {{-- TITLE --}}
    <div>
        <h5 class="mb-0 fw-bold">Sistem Monitoring Black Dragger Camp</h5>
        <small class="text-muted">
            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
        </small>
    </div>

    {{-- USER --}}
    <div class="d-flex align-items-center gap-3">

        {{-- NOTIF (OPSIONAL) --}}
        <span style="font-size:18px;">🔔</span>

        {{-- FOTO --}}
        @if(Auth::user()->foto)
            <img src="{{ asset('storage/' . Auth::user()->foto) }}"
                 style="width:35px; height:35px; border-radius:50%; object-fit:cover;">
        @else
            <div style="
                width:35px;
                height:35px;
                border-radius:50%;
                background:#0ea5e9;
                color:white;
                display:flex;
                align-items:center;
                justify-content:center;
                font-weight:bold;
            ">
                {{ strtoupper(substr(Auth::user()->nama,0,1)) }}
            </div>
        @endif

        {{-- NAMA --}}
        <span class="fw-semibold">
            Halo, {{ Auth::user()->nama }}
        </span>

    </div>

</div>