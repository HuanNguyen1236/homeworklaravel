@extends('admin.adminpanel')
@section('content')
    <div class="card">
        <div class="card-header">
            List user
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Age</th>
                        <th scope="col">Address</th>
                        <th><input type="checkbox"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td><img src="{{ asset($user->avatar) }}" alt="" style="width:30%"></td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->age }}</td>
                            <td>{{ $user->address }}</td>
                            <td style="display:flex">
                                <a href="{{ route('admin.removeUser', ['id' => $user->id]) }}" class="btn btn-danger">Remove user</a>
                                {{-- <button type="button" class="btn btn-warning"
                                    href="{{ route('admin.removeUser', ['id' => $user->id]) }}">Delete
                                    User</button> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <hr>
            <div style="text-align: end">
                <a href="{{ route('clearUser') }}" class="btn btn-danger">Remove all user</a>
            </div>
        </div>
    </div>
@endsection
