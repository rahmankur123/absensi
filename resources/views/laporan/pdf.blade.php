<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Absensi</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2, p {
            text-align: center;
            margin: 0;
        }

        .periode {
            margin-bottom: 15px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background-color: #a1c9f1;
            color: black;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>

<h2>LAPORAN ABSENSI BULANAN</h2>

<p class="periode">
    Bulan 
    {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }} 
    {{ $tahun }}
</p>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Jadwal</th>
            <th>Hadir</th>
            <th>Izin</th>
            <th>Tidak Hadir</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $d)

        @php
            $hadir = $d->kehadiran->where('status','hadir')->count();
            $izin = $d->kehadiran->where('status','izin')->count();
            $tidak = $d->kehadiran->where('status','tidak_hadir')->count();
        @endphp

        <tr>
            {{-- TANGGAL --}}
            <td>
                {{ \Carbon\Carbon::parse($d->tanggal)->translatedFormat('d F Y') }}
            </td>

            {{-- JADWAL --}}
            <td>
                {{ ucfirst($d->jadwal->hari) }}
                <br>
                (
                {{ \Carbon\Carbon::parse($d->jadwal->jam_mulai)->format('H.i') }}
                -
                {{ \Carbon\Carbon::parse($d->jadwal->jam_selesai)->format('H.i') }}
                )
            </td>

            <td>{{ $hadir }}</td>
            <td>{{ $izin }}</td>
            <td>{{ $tidak }}</td>
        </tr>

        @empty
        <tr>
            <td colspan="5">
                Tidak ada data latihan pada bulan ini
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- FOOTER --}}
<div class="footer">
    <p>
        Dicetak pada: 
        {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
    </p>
</div>

</body>
</html>