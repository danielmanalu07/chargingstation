@extends('admin.layout.baselayout')
@section('title', 'Customer')

@section('content')

    <!-- breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Customers</li>
        </ol>
    </nav>

    <!-- inisial value -->
    <input type="hidden" name="name" id="name" value="{{ isset($_GET['name']) ? $_GET['name'] : '' }}">

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-fw fa-solid fa-users me-1"></i>
            Customers
        </div>
        <div class="card-body">
            <table class="table" id="datatablesSimple">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Verified</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->is_verified ? 'Yes' : 'No' }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $customers->links() }}
        </div>
    </div>

@endsection
