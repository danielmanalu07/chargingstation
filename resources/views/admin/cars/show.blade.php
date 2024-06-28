<!-- resources/views/admin/cars/show.blade.php -->
@extends('admin.layout.baselayout')
@section('title', 'Car Details')
@section('content')
    <div class="container">
        <h1>Car Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nama: {{ $cars->nama }}</h5>
                <p class="card-text">Image: <img class="img-account-profile mb-2 d-block" id="image-preview" width="150"
                        src="{{ asset('storage/' . $cars->image) }}" alt="Car Image"></p>
                <p class="card-text">Voltage: @foreach ($cars->voltages as $voltage)
                        {{ $voltage->voltage }}V ({{ $voltage->type }})@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </p>
                <p class="card-text">Capacity:
                    @foreach ($cars->capacities as $capacity)
                        {{ $capacity->amount_capacity }} ({{ $capacity->type }})@if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                </p>
                <p class="card-text">Plug: {{ $cars->plug->nama }}</p>
                <p class="card-text">Category: {{ $cars->categoryCar->name }}</p>
                <p class="card-text">Deskripsi: {{ $cars->deskripsi }}</p>
                <a href="{{ route('car.index') }}" class="btn btn-primary">Back to List</a>
            </div>
        </div>
    </div>
@endsection
