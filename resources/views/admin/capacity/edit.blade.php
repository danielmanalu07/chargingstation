<!-- resources/views/admin/Voltages/edit.blade.php -->
@extends('admin.layout.baselayout')
@section('title', 'Edit Voltage')
@section('content')
<div class="container">

    <form action="{{ route('capacities.update', $capacity) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="amount_capacity" class="form-label">Amount Capacity</label>
            <input type="text" name="amount_capacity" class="form-control" id="amount_capacity" value="{{ $capacity->amount_capacity }}" required>
            @error('amount_capacity')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" name="type" class="form-control" id="type" value="{{ $capacity->type }}" required>
            @error('type')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection