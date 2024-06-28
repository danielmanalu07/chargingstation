<!-- resources/views/admin/plugs/show.blade.php -->
@extends('admin.layout.baselayout')
@section('title', 'Plug Details')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $plug->id }}</h5>
            <p class="card-text">Nama: {{ $plug->nama }}</p>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ route('plugs.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
