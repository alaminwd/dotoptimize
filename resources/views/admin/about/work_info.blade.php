@extends('layouts.dashboard')

@section('content')
    @can('work_info')
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white ml-auto mr-auto">Update Wrok Area Information</h3>
                </div>
                @if (session('work'))
                    <div class="alert alert-success">{{session('work')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('work.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="hidden" name="work_id" value="{{$work_info->id}}">
                            <input type="text" name="title" class="form-control" value="{{$work_info->title}}">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="desp" class="form-control">{{$work_info->desp}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Video Link</label>
                            <input type="text" class="form-control" name="video_link" value="{{$work_info->video_link}}">
                          
                        </div>
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="file" class="form-control" name="image">
                            @error('image')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            @if (session('photo_error'))
                            <strong class="text-danger">{{session('photo_error')}}</strong>
                            @endif
                           
                        </div>
                        <div class="row">
                            <div class="col-lg-4 m-auto">
                                <div class="mb-3">
                                    <button class="btn bg-primary text-white form-control" type="submit">Update Work Info</button>
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