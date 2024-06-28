<!-- resources/views/admin/cars/index.blade.php -->
@extends('admin.layout.baselayout')
@section('title', 'Cars')
@section('content')
    <div class="container">
        <h1>Cars List</h1>
        <a href="{{ url('/admin/car/create') }}" class="btn btn-primary mb-3">Add New Car</a>
        @if ($cars->isEmpty())
            <p>No cars available.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Voltage</th>
                        <th>Capacity</th>
                        <th>Plug</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                        <tr>
                            <td>{{ $car->id }}</td>
                            <td>{{ $car->nama }}</td>
                            <td>
                                @foreach ($car->voltages as $voltage)
                                    {{ $voltage->voltage }}V ({{ $voltage->type }})@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @foreach ($car->capacities as $capacity)
                                    {{ $capacity->amount_capacity }} ({{ $capacity->type }})@if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $car->plug->nama }}</td>
                            <td>{{ $car->categoryCar->name }}</td>
                            <td>
                                <a href="{{ route('car.show', $car->id) }}" class="btn btn-info">View</a>
                                <a href="{{ route('car.edit', $car->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('car.destroy', $car->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
