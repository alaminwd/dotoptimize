@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="ml-auto mr-auto text-white">Blog Info</h3>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-lg-8 m-auto">
                                <img src="{{asset('upload/blog')}}/{{$blog_info->image}}" alt="">
                            </div>
                        </div>
                        <div class="mb-3 mt-5">
                            <label>Cateory Name</label>
                            <input type="text" class="form-control" readonly value="{{$blog_info->rel_to_category->category_name}}">
                        </div>
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" class="form-control" value="{{$blog_info->title}}">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea class="summernote">{{$blog_info->desp}}</textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            @if ($tag_info->count())
            <div class="card">
                <div class="card-header">
                    <h3>Tag List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Tag Name</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($tag_info as $sl=>$tag)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$tag->rel_to_tag->tag_name}}</td>
                                <td>
                                    <a href="{{route('blog.tag.delete', $tag->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @endif
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Tag</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('blog.tag.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Add Tag</label>
                            <input type="hidden" name="blog_id" value="{{$blog_info->id}}">
                            <select name="tag_id" class="form-control">
                                <option value=""></option>
                                @foreach ($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->tag_name}}</option>
                                @endforeach
                            </select>
                            @error('tag_id')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Add Tag</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection