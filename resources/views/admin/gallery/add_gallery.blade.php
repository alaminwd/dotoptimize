@extends('layouts.dashboard')

@section('content')
    @can('add_gallery')
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Gallery Image List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Gallery Name</th>
                            <th>Gallery Image</th>
                            <th>Action</th>
                        </tr>
                        
                        @foreach ($galleries as $sl=>$gal)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$gal->gallery_name}}</td>
                                <td>
                                    <img width="70" src="{{asset('upload/gallery')}}/{{$gal->gallery_image}}" alt="">
                                </td>
                                <td>
                                    <a href="{{route('gallery.delete', $gal->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>{{$galleries->links()}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Gallery</h3>
                </div>
                @if (session('gallery'))
                    <div class="alert alert-success">{{session('gallery')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('gallery.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Image Name</label>
                            <input type="text" class="form-control" name="gallery_name">
                            @error('gallery_name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Gallery Image</label>
                            <input type="file" class="form-control" name="gallery_image">
                            @error('gallery_image')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            @if (session('photo_error'))
                                <strong class="text-danger">{{session('photo_error')}}</strong>
                            @endif
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Add Gallery</button>
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