@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Add Section Title</h3>
            </div>
            <div class="card-body">
            @foreach ($titles as $title)
            <form action="{{route('title.update')}}" method="POST">
                @csrf
                    <div class="mb-3">
                        <label>Section Title</label>
                        <input type="text" class="form-control" name="title" value="{{$title->title}}">
                        <input type="hidden" class="form-control" name="id" value="{{$title->id}}">
                        @error('title')
                           <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label>Section Description</label>
                        <input type="text" class="form-control" name="desp" value="{{$title->desp}}"> 
                        @error('desp')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                  <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update </button>
                  </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection