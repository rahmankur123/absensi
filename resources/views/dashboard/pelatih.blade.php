@extends('layouts.app')

@section('content')
<h4>Dashboard Pelatih</h4>

<div class="card p-3">
    <h5>Jumlah Atlet</h5>
    <h3>{{ \App\Models\Atlet::count() }}</h3>
</div>

<hr>

<h5>Menu</h5>
<a href="#" class="btn btn-primary">Absensi</a>
<a href="#" class="btn btn-warning">Evaluasi Atlet</a>

@endsection