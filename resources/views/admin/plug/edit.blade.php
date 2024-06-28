<!-- resources/views/admin/plugs/edit.blade.php -->
@extends('admin.layout.baselayout')
@section('title', 'Edit Plug')
@section('content')
<div class="container">
    <h1>Edit Plug</h1>
    <form action="{{ url('/admin/plugs', $plug->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" id="nama" value="{{ $plug->nama }}" required>
            @error('nama')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
