<!-- resources/views/admin/capacity/index.blade.php -->
@extends('admin.layout.baselayout')
@section('title', 'Capacities List')
@section('content')
    <div class="container">
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Amount Capacity</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($capacities as $index => $capacity)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $capacity->amount_capacity }} kWh </td>
                        <td>{{ $capacity->type }}</td>
                        <td>
                            <a href="{{ route('capacities.edit', $capacity) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('capacities.destroy', $capacity) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
