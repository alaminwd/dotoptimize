@extends('layouts.dashboard')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header">
                 <h3>Update Home Page SEO</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('company.seo.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="hidden" name="seo_id" value="{{$seos->id}}">
                            <input type="text" class="form-control" name="title" value="{{$seos->title}}">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <input type="text" class="form-control" name="desp" value="{{$seos->desp}}">
                        </div>
                        <div class="mb-3">
                            <label>Tag</label>
                            <input type="text" class="form-control" name="tag" value="{{$seos->tag}}">
                        </div>
                        <div class="mb-3">
                            <label>Image</label>
                            <input type="file" class="form-control" name="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">        
                        </div>
                        <div class="mb-3">
                            <img src="{{asset('upload/company_seo_img')}}/{{$seos->image}}" id="blah" alt="your image" width="100" height="100" />
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Update SEO</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection