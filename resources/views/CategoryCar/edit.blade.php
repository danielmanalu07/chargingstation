@extends('admin.layout.baselayout')
@section('title')
    Edit Category
@endsection
@section('content')
    <form action="/admin/categorycar/{{ $cc->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Name Category</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $cc->name }}">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">Update</button>
        <a class="btn btn-info" href="/admin/categorycar">Back</a>
    </form>
@endsection
