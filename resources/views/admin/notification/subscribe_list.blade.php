@extends('layouts.dashboard')

@section('content')
    @can('subscription')
    <div class="row mt-4">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Subscription List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($subscribes as $sl=>$subscribe)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$subscribe->email}}</td>
                                <td>
                                    <a href="{{route('subscribe.delete', $subscribe->id)}}" class="btn btn-danger">Delete</a>
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