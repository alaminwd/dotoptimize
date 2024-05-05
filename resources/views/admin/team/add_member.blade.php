@extends('layouts.dashboard')

@section('content')
    @can('add_member')
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white ml-auto mr-auto">Add Member</h3>
                </div>
                @if (session('team'))
                    <div class="alert alert-success">{{session('team')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('member.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name">
                                    @error('name')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email">
                                    @error('email')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Role</label>
                                    <input type="text" class="form-control" name="role">
                                    @error('role')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Phone</label>
                                    <input type="number" class="form-control" name="phone">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label>Short Desp</label>
                                    <input type="text" class="form-control" name="short_desp">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label>About Member</label>
                                    <textarea name="about" class="form-control"></textarea>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address">
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
                                    <button class="btn bg-primary form-control text-white" type="submit">Add Member</button>
                                </div>
                            </div>
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