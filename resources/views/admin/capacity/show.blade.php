<!-- resources/views/admin/Voltages/show.blade.php -->
@extends('admin.layout.baselayout')
@section('title', 'Capacity Details')
@section('content')
<div class="container">
    <div class="mb-3">
        <label class="form-label">ID:</label>
        <p>{{ $capacity->id }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Amount Capacity:</label>
        <p>{{ $capacity->amount_capacity }}</p>
    </div>
    <div class="mb-3">
        <label class="form-label">Type:</label>
        <p>{{ $capacity->type }}</p>
    </div>
    <a href="{{ route('capacities.index') }}" class="btn btn-primary">Back to list</a>
</div>
@endsection