@extends('layouts.dashboard');

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Update Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('product.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="mb-3">
                                <label >Title</label>
                                <input type="text" name="title" class="form-control" value="{{$product->title}}">
                                <input type="hidden" name="id" class="form-control" value="{{$product->id}}">
                            </div>
                            <div class="mb-3">
                                <label >Image</label>
                                <input type="file" name="image"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-3">
                                <img id="blah" src="{{asset('upload/product')}}/{{$product->image}}" alt="your image" width="100" height="100" />
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
