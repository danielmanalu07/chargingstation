@extends('admin.layout.baselayout')
@section('title')
    Create Category Cars
@endsection
@section('content')
    <form action="{{ url('/admin/categorycar') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name Category</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
