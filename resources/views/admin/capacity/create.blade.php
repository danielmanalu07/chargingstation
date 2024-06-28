<!-- resources/views/admin/Capacity/create.blade.php -->
@extends('admin.layout.baselayout')
@section('title', 'Create New Capacity')
@section('content')
    <div class="container">
        <form action="{{ route('capacities.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="amount_capacity" class="form-label">Amount Capacity</label>
                <input type="text" name="amount_capacity" class="form-control" id="amount_capacity" required>
                @error('amount_capacity')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select name="type" class="form-control select2" id="type" required>
                    <option id="type" value="Min">Min</option>
                    <option id="type" value="Max">Max</option>
                    <option id="type" value="Min & Max">Min & Max</option>
                </select>
                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
