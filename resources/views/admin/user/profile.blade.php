@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-4 mt-5">
            <div class="card" >
                <div class="card-header bg-primary">
                    <h3 class="text-white">Edit Your Info</h3>
                </div>
                @if (session('profile_success'))
                    <div class="alert alert-success">{{session('profile_success')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('profile.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{Auth::user()->email}}">
                            @error('email')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Update Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-5">
            <div class="card" >
                <div class="card-header bg-primary">
                    <h3 class="text-white">Edit Your Password</h3>
                </div>
                @if (session('pass_succ'))
                    <div class="alert alert-success">{{session('pass_succ')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('password.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Old Password</label>
                            <input type="password" name="old_password" class="form-control">
                            @error('old_password')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            @if (session('old_wrong'))
                                <strong class="text-danger">{{session('old_wrong')}}</strong>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label>New Password</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mt-5">
            <div class="card" style="height: auto;">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Update profile picture</h3>
                </div>
                @if (session('profile_photo'))
                    <div class="alert alert-success">{{session('profile_photo')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('photo.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Picture</label>
                            <input type="file" name="photo" class="form-control">
                            <h4 class="text-dark mt-2">Image size should be 60X60</h4>
                            @error('photo')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            @if (session('photo_error'))
                                <strong class="text-danger">{{session('photo_error')}}</strong>
                            @endif
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Update Picture</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection