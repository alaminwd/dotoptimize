@extends('layouts.dashboard')

@section('content')
    @can('add_review')
    <div class="row mt-3">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>All Review list</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Profession</th>
                            <th>Logo</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($reivews as $sl=>$review)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$review->name}}</td>
                                <td>{{substr($review->profession, 0, 20)}}</td>
                                <td>
                                    <img width="60" src="{{asset('upload/review')}}/{{$review->logo}}" alt="">
                                </td>
                                <td>
                                    <div class="dropdown mb-3">
                                        <a href="javascript:void(0)" class="more-button" data-toggle="dropdown" aria-expanded="false">
                                            <svg width="6" height="26" viewBox="0 0 6 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 3C6 4.65685 4.65685 6 3 6C1.34315 6 0 4.65685 0 3C0 1.34315 1.34315 0 3 0C4.65685 0 6 1.34315 6 3Z" fill="#585858"></path>
                                                <path d="M6 13C6 14.6569 4.65685 16 3 16C1.34315 16 0 14.6569 0 13C0 11.3431 1.34315 10 3 10C4.65685 10 6 11.3431 6 13Z" fill="#585858"></path>
                                                <path d="M6 23C6 24.6569 4.65685 26 3 26C1.34315 26 0 24.6569 0 23C0 21.3431 1.34315 20 3 20C4.65685 20 6 21.3431 6 23Z" fill="#585858"></path>
                                            </svg>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{route('review.edit', $review->id)}}" class="dropdown-item">Edit</a>
                                                <a href="{{route('review.delete', $review->id)}}" class="dropdown-item">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add review</h3>
                </div>
                @if (session('review'))
                    <div class="alert alert-success">{{session('review')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('review.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name">
                            @error('name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Profession</label>
                            <input type="text" class="form-control" name="profession">
                            @error('profession')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Comment</label>
                            <textarea name="comment" class="form-control"></textarea>
                            @error('comment')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
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
                            <button class="btn btn-primary" type="submit">Add Review</button>
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