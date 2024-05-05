@extends('layouts.dashboard');

@section('content')
@can('add_logo')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>All logos List</h3>
                </div>
                @if (session('logodel'))
                    <div class="alert alert-success">{{session('logodel')}}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Logo Name</th>
                            <th>Logo Image</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($logos as $sl=>$logo)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$logo->logo_name}}</td>
                                <td><img width="60" src="{{asset('upload/logo')}}/{{$logo->logo}}" alt=""></td>
                                <td>
                                    <a href="{{route('logo.delete', $logo->id)}}" class="btn btn-danger">Delete</a>
                                    <a href="{{route('logo.status', $logo->id)}}" class="btn btn-{{$logo->status == 1?'success':'light'}}">{{$logo->status == 1?'Active':'Deactive'}}</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add new Logo</h3>
                </div>
                @if (session('logoadd'))
                    <div class="alert alert-success">{{session('logoadd')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('logo.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Logo Name</label>
                            <input type="text" name="logo_name" class="form-control">
                            @error('logo_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label>Logo Image</label>
                            <input type="file" class="form-control" name="logo">
                            @error('logo')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            @if (session('photo_error'))
                                <strong class="text-danger">{{session('photo_error')}}</strong>
                            @endif
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Add Logo</button>
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