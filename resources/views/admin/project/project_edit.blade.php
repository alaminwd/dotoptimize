@extends('layouts.dashboard');

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Update Project</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('project.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                                <label >Title</label>
                                <input type="text" name="title" class="form-control" value="{{$projects->title}}">
                                <input type="hidden" name="id" class="form-control" value="{{$projects->id}}">
                                @error('title')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label >Client</label>
                                <input type="text" name="client" class="form-control" value="{{$projects->client}}">
                                @error('client')
                                     <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label >Author</label>
                                <input type="text" name="author" class="form-control" value="{{$projects->author}}">
                                @error('author')
                                     <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label >Place</label>
                                <input type="text" name="place" class="form-control" value="{{$projects->place}}">
                                @error('place')
                                  <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label >Short Description</label>
                                <input type="text" name="short_desp" class="form-control" value="{{$projects->desp}}">
                                @error('short_desp')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label >Long Description</label>
                                <textarea name="long_desp" id="summernote">
                                    {{$projects->long_desp}}
                                </textarea>
                                @error('long_desp')
                                     <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label >Image</label>
                                <input type="file" name="image"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-3">
                                <img id="blah" src="{{asset('upload/project')}}/{{$projects->image}}" alt="your image" width="100" height="100" />
                            </div>
                            <div class="mb-3">
                               <button type="submit" class="btn btn-info">Update Project</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')

    <script>
        $('#summernote').summernote();
    </script>
@endsection
