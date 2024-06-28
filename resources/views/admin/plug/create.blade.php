<!-- resources/views/admin/plugs/create.blade.php -->
@extends('admin.layout.baselayout')
@section('title', 'Create New Plug')
@section('content')
<div class="container">
    <form action="{{ url('/admin/plugs') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" required>
            @error('nama')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
