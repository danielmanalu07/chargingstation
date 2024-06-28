<!-- resources/views/admin/Voltages/show.blade.php -->
@extends('admin.layout.baselayout')
@section('title', 'Voltage Details')
@section('content')
    <div class="container">


        <div class="mb-3">
            <label for="voltage" class="form-label">Voltage</label>
            <input type="text" class="form-control" id="voltage" value="{{ $voltage->voltage }}" readonly>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" id="type" value="{{ $voltage->type }}" readonly>
        </div>

        <a href="{{ route('voltages.index') }}" class="btn btn-secondary">Back</a>
    </div>
@endsection
