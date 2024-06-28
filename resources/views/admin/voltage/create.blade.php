<!-- resources/views/admin/Voltages/create.blade.php -->
@extends('admin.layout.baselayout')
@section('title', 'Create New Voltage')
@section('content')
    <div class="container">

        <form action="{{ route('voltages.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="voltage" class="form-label">Voltage</label>
                <input type="number" name="voltage" class="form-control" id="voltage" required>
                @error('voltage')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select name="type" class="form-control select2" id="type" required>
                    <option value="Level 1">Level 1</option>
                    <option value="Level 2">Level 2</option>
                    <option value="AC Charging">AC Charging</option>
                    <option value="DC FastCharging">DC FastCharging</option>
                </select>
                @error('type')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
