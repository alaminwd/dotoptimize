@extends('layouts.dashboard');

@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Add Section Title</h3>
                </div>
                <div class="card-body">
                @foreach ( $section_title as $title)
                <form action="{{route('section.title.update')}}" method="POST">
                    @csrf
                        <div class="mb-3">
                            <label>Section Title</label>
                            <input type="text" class="form-control" name="section_title" value="{{$title->section_title}}">
                            <input type="hidden" class="form-control" name="id" value="{{$title->id}}">
                            @error('section_title')
                               <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Section Description</label>
                            <input type="text" class="form-control" name="section_desp" value="{{$title->section_desp}}"> 
                            @error('section_desp')
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