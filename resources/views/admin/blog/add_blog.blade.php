@extends('layouts.dashboard')

@section('content')
    @can('add_blog')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-center text-white">Add Blog</h3>
                </div>
                @if (session('blog'))
                    <div class="alert alert-success">{{session('blog')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Cateory Name</label>
                            <select name="category_id" class="form-control">
                                <option value="">--select any--</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title">
                            @error('title')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Short Description</label>
                            <input type="text" class="form-control" name="desp">
                            @error('desp')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Long Description</label>
                            <textarea id="summernote" name="long_desp"></textarea>
                            @error('long_desp')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
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
                         <div class="row">
                            <div class="col-lg-4 m-auto">
                                <div class="mb-3">
                                    <button class="btn bg-primary text-white form-control" type="submit">Add blog</button>
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