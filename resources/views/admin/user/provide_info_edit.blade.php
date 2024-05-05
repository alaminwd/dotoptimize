@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-5 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Provide Your Information</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('provide.edit')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control" value="{{$value->name}}"> 
                                <input type="hidden" name="id" class="form-control" value="{{$value->id}}">
                                @error('name')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Phone Number</label>
                                <input type="number" name="phone" class="form-control" value="{{$value->phone}}">
                                @error('phone')
                                     <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Full Address</label>
                                <input type="text" name="address" class="form-control" value="{{$value->address}}">
                                @error('address')
                                  <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Facebook Link</label>
                                <input type="text" name="link" class="form-control" value="{{$value->link}}">
                                @error('link')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-info w-100" style="font-size: 16px; font-weight:600">update info</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection