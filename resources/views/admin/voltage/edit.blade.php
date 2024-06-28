<!-- resources/views/admin/Voltages/edit.blade.php -->
@extends('admin.layout.baselayout')
@section('title', 'Edit Voltage')
@section('content')
    <div class="container">

        <form action="{{ route('voltages.update', $voltage->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="voltage" class="form-label">Voltage</label>
                <input type="number" name="voltage" class="form-control" id="voltage" value="{{ $voltage->voltage }}" required>
                @error('voltage')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <input type="text" name="type" class="form-control" id="type" value="{{ $voltage->type }}" required>
                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection