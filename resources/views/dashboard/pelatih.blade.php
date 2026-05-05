@extends('layouts.app')

@section('content')
<h4>Dashboard Pelatih</h4>

<div class="card p-3">
    <h5>Jumlah Atlet</h5>
    <h3>{{ \App\Models\Atlet::count() }}</h3>
</div>

<hr>

@endsection