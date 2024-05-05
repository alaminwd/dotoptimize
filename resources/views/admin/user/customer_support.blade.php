@extends('layouts.dashboard')


@section('content')
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Support Message</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                       <tr>
                            <th>sl</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Download File</th>
                            <th>Action</th>
                       </tr>
                       @foreach ( $supports as $sl => $support )
                           
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$support->rel_to_customer->name}}</td>
                                <td>{{$support->rel_to_customer->email}}</td>
                                <td><a href="{{route('support.details', $support->id)}}">{{substr($support->title, 0, 25) }}...</a></td>
                                <td><a href="{{route('support.details', $support->id)}}">{{substr($support->desp, 0, 30)}}...</a></td>
                                <td>
                                    <a href="{{route('document.file.download', $support->id)}}" class="badge badge-info">Download File</a>
                                </td>
                                <td>
                                    <a href="{{route('support.info.delete', $support->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                                
                            </tr>
                       @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection