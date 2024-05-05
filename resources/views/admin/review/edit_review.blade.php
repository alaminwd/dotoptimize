@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit review</h3>
                </div>
                @if (session('review'))
                    <div class="alert alert-success">{{session('review')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('review.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="hidden" value="{{$review_info->id}}" name="review_id">
                            <input type="text" class="form-control" name="name" value="{{$review_info->name}}">
                        </div>
                        <div class="mb-3">
                            <label>Profession</label>
                            <input type="text" class="form-control" name="profession" value="{{$review_info->profession}}">
                        </div>
                        <div class="mb-3">
                            <label>Comment</label>
                            <textarea name="comment" class="form-control">{{$review_info->comment}}</textarea>
                            
                        </div>
                        <div class="mb-3">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="logo">
                            @error('logo')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            @if (session('photo_error'))
                                <strong class="text-danger">{{session('photo_error')}}</strong>
                            @endif
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Update Review</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection