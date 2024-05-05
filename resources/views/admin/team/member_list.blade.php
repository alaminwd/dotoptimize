@extends('layouts.dashboard')

@section('content')
    @can('member_list')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>All Member List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($members as $member)
                            <tr>
                                <td>{{$member->name}}</td>
                                <td>{{$member->email}}</td>
                                <td>{{$member->role}}</td>
                                <td>
                                    <img width="60" src="{{asset('upload/team')}}/{{$member->image}}" alt="">
                                </td>
                                <td>
                                    <a href="{{route('member.edit', $member->id)}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route('member.delete', $member->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
    <h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
    @endcan
@endsection