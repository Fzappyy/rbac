@extends('mainLayout')

@section('title','Manage Users')

@section('page-content')
<div class="container-fluid">
    <div class="row">
        <div>
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
                                <button type="submit" name="user_id" value="{{ $user->id }}" class="btn btn-primary">Save</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        </div>
        <div class="col">
            <a href="{{ route('dash') }}" class="btn btn-danger">Back</a>
        </div>
    </div>
</div>

@endsection