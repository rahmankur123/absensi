@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>Data Atlet</h4>
</div>

{{-- SEARCH --}}
<form method="GET" class="mb-3">
    <div class="row">
        <div class="col-md-4">
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   class="form-control"
                   placeholder="Cari nama / email...">
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">Search</button>
        </div>
    </div>
</form>

{{-- TABLE --}}
<div class="card p-3 shadow-sm">

<table class="table table-bordered table-hover">
    <thead class="table-info text-center">
        <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Jenis Kelamin</th>
            <th>No HP</th>
            <th width="200">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse($data as $d)
        <tr>

            {{-- NAMA --}}
            <td>{{ $d->user->nama }}</td>

            {{-- EMAIL --}}
            <td>{{ $d->user->email }}</td>

            {{-- JK --}}
            <td class="text-center">
                <span class="badge 
                    {{ $d->jenis_kelamin == 'Laki-laki' ? 'bg-primary' : 'bg-danger' }}">
                    {{ $d->jenis_kelamin }}
                </span>
            </td>

            {{-- NO HP --}}
            <td>{{ $d->user->no_hp }}</td>

            {{-- AKSI --}}
            <td>

                <a href="/pelatih/atlet/{{ $d->id }}" 
                   class="btn btn-info btn-sm">
                    Detail
                </a>

                <a href="/pelatih/rekap-atlet/{{ $d->id }}" 
                   class="btn btn-primary btn-sm">
                    Rekap
                </a>

            </td>

        </tr>

        @empty
        <tr>
            <td colspan="5" class="text-center py-5">
                <div style="font-size:40px;">🏃‍♂️</div>
                <div class="text-muted mt-2">
                    Belum ada data atlet
                </div>
            </td>
        </tr>
        @endforelse
    </tbody>

</table>

{{-- PAGINATION --}}
<div class="mt-3">
    {{ $data->links() }}
</div>

</div>

@endsection