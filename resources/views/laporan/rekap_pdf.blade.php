<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rekap Atlet</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h2, p {
            text-align: center;
            margin: 0;
        }

        .info {
            margin: 10px 0 15px;
            text-align: left;
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

<h2>REKAP KEHADIRAN ATLET</h2>

<p>
    Bulan 
    {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }} 
    {{ $tahun }}
</p>

<div class="info">
    <b>Nama Atlet:</b> {{ $atlet->user->nama }}
</div>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Jadwal</th>
            <th>Status</th>
            <th>Teknik</th>
            <th>Fisik</th>
            <th>Mental</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $d)

        <tr>

            {{-- TANGGAL --}}
            <td>
                {{ \Carbon\Carbon::parse($d->absensi->tanggal)->translatedFormat('d F Y') }}
            </td>

            {{-- JADWAL --}}
            <td>
                {{ ucfirst($d->absensi->jadwal->hari) }}
                <br>
                (
                {{ \Carbon\Carbon::parse($d->absensi->jadwal->jam_mulai)->format('H.i') }}
                -
                {{ \Carbon\Carbon::parse($d->absensi->jadwal->jam_selesai)->format('H.i') }}
                )
            </td>

            {{-- STATUS --}}
            <td>
                {{ ucfirst(str_replace('_',' ', $d->status)) }}
            </td>

            {{-- EVALUASI --}}
            <td>
                {{ $d->status == 'hadir' ? ($d->evaluasi_teknik ?? '-') : '-' }}
            </td>

            <td>
                {{ $d->status == 'hadir' ? ($d->evaluasi_fisik ?? '-') : '-' }}
            </td>

            <td>
                {{ $d->status == 'hadir' ? ($d->evaluasi_mental ?? '-') : '-' }}
            </td>

        </tr>

        @empty
        <tr>
            <td colspan="6">
                Tidak ada data latihan pada periode ini
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