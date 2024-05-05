@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-lg-10 m-auto">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white ml-auto mr-auto">Edit Member Info</h3>
            </div>
            @if (session('team'))
                <div class="alert alert-success">{{session('team')}}</div>
            @endif
            <div class="card-body">
                <form action="{{route('member.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Name</label>
                                <input type="hidden" name="member_id" value="{{$member_info->id}}">
                                <input type="text" class="form-control" name="name" value="{{$member_info->name}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{$member_info->email}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Role</label>
                                <input type="text" class="form-control" name="role" value="{{$member_info->role}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Phone</label>
                                <input type="number" class="form-control" name="phone" value="{{$member_info->phone}}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label>Short Desp</label>
                                <input type="text" class="form-control" name="short_desp" value="{{$member_info->short_desp}}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label>About Member</label>
                                <textarea name="about" class="form-control">{{$member_info->about}}</textarea>
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address" value="{{$member_info->address}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Image</label>
                                <input type="file" class="form-control" name="image">
                                @error('image')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                                @if (session('photo_error'))
                                    <strong class="text-danger">{{session('photo_error')}}</strong>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4 m-auto">
                            <div class="mb-3">
                                <button class="btn bg-primary form-control text-white" type="submit">Update Member</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection