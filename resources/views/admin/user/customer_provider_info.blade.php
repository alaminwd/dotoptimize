@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-hover">
                    <tr>
                        <th>sl</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Facebook Link</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($provide_info as $sl=>$info)
                    <tr>
                        <td>{{$sl+1}}</td>
                        <td>{{$info->name}}</td>
                        <td>{{$info->number}}</td>
                        <td>{{$info->address}}</td>
                        <td>{{$info->link}}</td>
                        <td>
                            <a class="btn btn-info" href="{{route('update.provide.info', $info->id)}}">Update</a>
                            <a  class="btn btn-danger" href="{{route('provide.info.delete', $info->id)}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection