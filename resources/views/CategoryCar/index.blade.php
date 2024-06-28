@extends('admin.layout.baselayout')
@section('title', 'Category Cars')
@section('content')
<div class="container">
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $key => $cc)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $cc->name }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ url('/admin/categorycar/' . $cc->id . '/edit') }}" class="btn btn-warning me-2">Update</a>
                            <form action="{{ url('/admin/categorycar/' . $cc->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Data Not Available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
