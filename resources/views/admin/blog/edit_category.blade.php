@extends('layouts.dashboard')

@section('content')
    <div class="row mt-4">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Category</h3>
                    </div>
                    @if (session('category'))
                        <div class="alert alert-success">{{session('category')}}</div>
                    @endif
                    <div class="card-body">
                        <form action="{{route('category.update')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Category Name</label>
                                <input type="hidden"  name="category_id" value="{{$category_info->id}}">
                                <input type="text" class="form-control" name="category_name" value="{{$category_info->category_name}}">
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" type="submit">Update category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection