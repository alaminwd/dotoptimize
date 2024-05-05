@extends('layouts.dashboard')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-atuo">
                <div class="card">
                    <div class="card-header">
                        <h3>update content</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('testimonial.content.update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                                <div class="mb-3">
                                    <label class="form-label">Sub Title</label>
                                    <input type="text" class="form-control" name="sub_title" value="{{$content->sub_title}}">
                                    <input type="hidden" class="form-control" name="id" value="{{$content->id}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="title"  value="{{$content->title}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                                </div>
                                <div class="mb-3">
                                    <img id="blah" alt="your image" width="100" height="100" src="{{asset('upload/testimonial')}}/{{$content->image}}" />
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-info">Save Content</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection