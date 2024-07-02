@extends('mainLayout')

@section('title', 'Manage Users')

@section('page-content')
<div class="container-fluid">
    <div class="row">
        <div class="col">
            @if(session('success'))
            <div class="alert alert-success" id="flash-message">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('admin.manageUsers') }}" method="POST">
                @csrf
                <table class="table table-striped table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>User ID</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Assigned Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <select name="role_id[{{ $user->id }}]" class="form-select">
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if($user->hasRole($role->name)) selected @endif>
                                        {{ $role->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <button type="submit" name="user_id" value="{{ $user->id }}" class="btn btn-primary">Save</button>
                                    <!-- Add space between buttons for better spacing -->
                                    &nbsp;
                                    <form action="{{ route('admin.deleteUser', ['id' => $user->id]) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col">
            <a href="{{ route('dash') }}" class="btn btn-danger">Back</a>
        </div>
    </div>
</div>

@endsection