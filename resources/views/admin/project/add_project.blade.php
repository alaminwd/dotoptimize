@extends('layouts.dashboard')
@section('content')
    @can('add_project')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white ml-auto mr-auto">Add Project</h3>
                </div>
                @if (session('project'))
                    <div class="alert alert-success">{{session('project')}}</div>
                @endif
                <div class="card-body">
                   <form action="{{route('project.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title">
                                @error('title')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Client Name</label>
                                <input type="text" class="form-control" name="client">
                                @error('client')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Author</label>
                                <input type="text" class="form-control" name="author">
                                @error('author')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label>Place</label>
                                <input type="text" class="form-control" name="place">
                                @error('place')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label>Short Description</label>
                                <input type="text" class="form-control" name="desp">
                                @error('desp')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label>Long Description</label>
                                <div  name="long_desp"></div>
                                <textarea name="long_desp" id="summernote"></textarea>
                                @error('long_desp')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Keyword</label>
                                <div  name="long_desp"></div>
                               <input type="text" name="keyword" class="form-control">
                                @error('long_desp')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label>Project Image</label>
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
                               <button class="btn text-white bg-primary form-control">Add Project</button>
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

@section('footer_script')

    <script>
        $('#summernote').summernote();
    </script>
@endsection