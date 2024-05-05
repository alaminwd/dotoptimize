@extends('layouts.dashboard')


@section('content')
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Office Address Info</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <tr>
                            <th>Title</th>
                            <th>Sub Title</th>
                            <th>Location</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($office_info as $info)
                            <tr>
                                <td>{{$info->title}}</td>
                                <td>{{$info->sub_title}}</td>
                                <td>{{$info->location}}</td>
                                <td>{{$info->phone}}</td>
                                <td>{{$info->email}}</td>
                                <td>
                                 
                                    <img src="{{asset('upload/office_address')}}/{{$info->image}}" width="100px" height="100px" alt="">
                                </td>
                                <td>
                                    <a href="{{route('delete.address',$info->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
       
    </div>
    <div class="row mt-5">
        <div class="col-lg-7">
            <div class="card">
                <div class="card-header">
                    <h3>Update Content</h3>
                </div>
                <div class="card-body">
                    @foreach ($contents as $content )
                    <form action="{{route('update.content')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Sub Title</label>
                            <input type="text" name="sub_title" class="form-control" value="{{$content->sub_title}}">
                            <input type="hidden" name="id" class="form-control" value="{{$content->id}}">
                        </div>
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" value="{{$content->title}}">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea id="summernote" name="desp" value="">{{$content->desp}}</textarea>
                            {{-- <input type="text" name="desp" class="form-control" > --}}
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </form>
                    @endforeach
                    
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card">
                <div class="card-header">
                    <h3>Add Address</h3>
                </div>
                <div class="card-body">
                  
                    <form action="{{route('add.address')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control">
                            @error('title')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sub Title</label>
                            <input type="text" name="sub_title" class="form-control">
                            @error('sub_title')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Location</label>
                            <input type="text" name="location" class="form-control">
                            @error('location')
                                 <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="number" name="phone" class="form-control">
                            @error('phone')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                            @error('email')
                                 <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
                            @error('image')
                                 <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-info">Add Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
    <script>
        $(document).ready(function() {
        $('#summernote').summernote();
            });
    </script>
@endsection