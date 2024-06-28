<!-- resources/views/admin/plugs/index.blade.php -->
@extends('admin.layout.baselayout')
@section('title', 'Plugs List')
@section('content')
<div class="container">
    <a href="{{ url('/admin/plugs/create') }}" class="btn btn-primary mb-3">Add New Plug</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($plugs->isEmpty())
        <p>No plugs available.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($plugs as $plug)
                    <tr>
                        <td>{{ $plug->id }}</td>
                        <td>{{ $plug->nama }}</td>
                        <td>
                            <a href="{{ route('plugs.show', $plug->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('plugs.edit', $plug->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('plugs.destroy', $plug->id) }}" method="POST" style="display:inline;">
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
