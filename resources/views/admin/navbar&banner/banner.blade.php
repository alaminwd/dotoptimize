@extends('layouts.dashboard')

@section('content')
    @can('banner_info')
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white ml-auto mr-auto">Edit Banner Info</h3>
                </div>
                @if (session('banner'))
                    <div class="alert alert-success">{{session('banner')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('banner.update')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-3">
                        <label>Title</label>
                        <input type="hidden" name="banner_id" value="{{$banner_info->id}}">
                        <input type="text" name="title" class="form-control" value="{{$banner_info->title}}">
                      </div>
                      <div class="mb-3">
                        <label>Description</label>
                        <input type="text" name="desp" class="form-control" value="{{$banner_info->desp}}">
                      </div>
                      <div class="mb-3">
                        <label>Banner Video</label>
                        <input type="file" name="image" class="form-control">
                        @error('image')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                      </div>
                      <div class="row">
                        <div class="col-lg-6 m-auto">
                            <div class="mb-3" >
                                <button class="btn bg-primary text-white form-control">Update Banner</button>
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