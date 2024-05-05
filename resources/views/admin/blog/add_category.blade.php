@extends('layouts.dashboard')

@section('content')
    @can('add_category')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Category List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($categories as $sl=>$category)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$category->category_name}}</td>
                                <td>
                                    <a href="{{route('category.edit', $category->id)}}" class="btn btn-info">Edit</a>
                                    <a href="{{route('category.delete', $category->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Category</h3>
                    </div>
                    @if (session('category'))
                        <div class="alert alert-success">{{session('category')}}</div>
                    @endif
                    <div class="card-body">
                        <form action="{{route('category.store')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Category Name</label>
                                <input type="text" class="form-control" name="category_name">
                                @error('category_name')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Add category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
    @endcan
@endsection