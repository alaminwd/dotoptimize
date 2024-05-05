@extends('layouts.dashboard')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header bg-info text-center">
                    <h3 class="text-white">Job Post Details</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                         <tr>
                           
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Action</th>
                         </tr>
                        @foreach ($careers as $sl=> $career)
                            <tr>
                              
                                <td>{{$career->title}}</td>
                                <td>{{$career->desp}}</td>
                                <td>
                                    <img width="100"   src="{{asset('upload/career')}}/{{$career->image}}" alt="">
                                </td>
                                <td>
                                    <a href="{{route('post.delete', $career->id)}}" class="btn btn-danger">Delete</a>
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
                    <h4>add Post</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('post.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Job Title</label>
                            <input type="text" name="job_title" class="form-control">
                            @error('job_title')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Job Description</label>
                            <input type="text" name="job_desp" class="form-control">
                            @error('job_desp')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" name="job_img" class="form-control">
                            @error('job_img')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        </div>
                        <div class="mb-3">
                           <button type="submit" class="btn btn-info w-100">Add post</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection