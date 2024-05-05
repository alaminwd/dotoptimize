@extends('layouts.dashboard')

@section('content')
   @can('role_manager')
    <div class="row mt-5">
        <div class="col-lg-12">
            {{-- <div class="card">
                <div class="card-header">
                    <h3>Add Permission</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('permission.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Add Permission</label>
                            <input type="text" class="form-control" name="permission">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Add Permission</button>
                        </div>
                    </form>
                </div>
            </div> --}}
            <div class="card">
                <div class="card-header">
                    <h3>Add Role</h3>
                </div>
                @if (session('role_succ'))
                    <div class="alert alert-success">{{session('role_succ')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('role.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Role name</label>
                            <input type="text" class="form-control" name="role_name">
                        </div>
                        <div class="mb-3">
                            <h6>Select Permission</h6>
                        <div class="mb-1 d-flex flex-wrap">
                            @foreach ($permissions as $permission)
                            <div class="form-check">
                                    <label for="per{{$permission->id}}" class="form-check-label" style="margin-right: 20px;">
                                    <input type="checkbox" name="permission[]" class="form-check-input" id="per{{$permission->id}}" value="{{$permission->name}}">
                                    {{$permission->name}}
                                   <i class="input-frame"></i></label>
                            </div>
                            @endforeach
                        </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Add role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Role has Permission</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Role</th>
                            <th>Permission</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($roles as $role)
                           <tr>
                            <td>{{$role->name}}</td>
                            <td>
                                @foreach ($role->getPermissionNames(); as $permission)
                                    <div class="badge badge-primary mb-3">{{$permission}}</div>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{route('role.delete', $role->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                           </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3>User Role</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>User</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($users as $user)
                           <tr>
                            <td>{{$user->name}}</td>
                            <td>
                                @forelse ($user->getRoleNames(); as $role)
                                    <div class="badge badge-primary">{{$role}}</div>
                                    @empty
                                    <div class="badge badge-success">Not Assigned</div>
                                @endforelse
                            </td>
                            <td>
                                <a href="{{route('remove.role', $user->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                           </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-5">
            <div class="card">
                <div class="card-header">
                    <h3>Assign Role</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('assign.role')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>User name</label>
                            <select name="user_id" class="form-control">
                                <option value="">--select user--</option>
                                @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Role name</label>
                            <select name="role_id" class="form-control">
                                <option value="">--select user--</option>
                                @foreach ($roles as $role)
                                    <option value="{{$role->name}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Assign role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
    @endcan
@endsection