@extends('layouts.dashboard')

@section('content')
    @can('edit_about_info')
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white ml-auto mr-auto">Edit About Info</h3>
                </div>
                @if (session('about'))
                    <div class="alert alert-success">{{session('about')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('about.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="hidden" name="about_id"  value="{{$about_info->id}}">
                            <input type="text" name="title" class="form-control" value="{{$about_info->title}}">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="desp" class="form-control">{{$about_info->desp}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Experience Year</label>
                            <input type="number" name="experience" class="form-control" value="{{$about_info->experience}}">
                        </div>
                        <div class="mb-3">
                            <label>Awards</label>
                            <input type="number" name="award" class="form-control" value="{{$about_info->award}}">
                        </div>
                        <div class="mb-3">
                            <label>Happy Clients</label>
                            <input type="number" name="client" class="form-control" value="{{$about_info->client}}">
                        </div>
                        <div class="mb-3">
                            <label>About Image</label>
                            <input type="file" name="image" class="form-control">
                            @error('image')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            @if (session('photo_error'))
                                <strong class="text-danger">{{session('photo_error')}}</strong>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-lg-6 m-auto">
                                <button class="btn bg-primary form-control text-white">Update About Info</button>
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