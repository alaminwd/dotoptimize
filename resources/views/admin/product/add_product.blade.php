@extends('layouts.dashboard')

@section('content')
<div class="row mt-3">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white ml-auto mr-auto">Add Product</h3>
            </div>
            @if (session('project'))
                <div class="alert alert-success">{{session('project')}}</div>
            @endif
            <div class="card-body">
               <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
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
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label>Short Description</label>
                            <input type="text" class="form-control" name="short_desp">
                            @error('short_desp')
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
                            <label> Keyword</label>
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
                           <button class="btn text-white bg-primary form-control">Add Product</button>
                        </div>
                    </div>
                </div>
               </form>
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