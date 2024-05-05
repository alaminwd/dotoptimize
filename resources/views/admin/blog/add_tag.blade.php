@extends('layouts.dashboard')

@section('content')
    @can('add_tag')
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>All Tags List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Tag Name</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($tags as $sl=>$tag)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$tag->tag_name}}</td>
                                <td>
                                    <a href="{{route('tag.delete', $tag->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>
                                {{$tags->links()}}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Tags</h3>
                </div>
                @if (session('tag'))
                    <div class="alert alert-success">{{session('tag')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('tag.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Tag Name</label>
                            <input type="text" class="form-control" name="tag_name">
                            @error('tag_name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Add blog</button>
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