<!-- resources/views/admin/Voltage/index.blade.php -->
@extends('admin.layout.baselayout')
@section('title', 'Voltage List')
@section('content')
    <div class="container">

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Voltage</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($voltages as $index => $voltage)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $voltage->voltage }} V</td>
                        <td>{{ $voltage->type }}</td>
                        <td>
                            <a href="{{ route('voltages.edit', $voltage->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('voltages.destroy', $voltage->id) }}" method="POST"
                                style="display:inline;">
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
