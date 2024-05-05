@extends('layouts.dashboard')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-9 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Product Section Info</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('product.section.info.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="hidden" name="section_id" value="{{$product_sections->id}}">
                            <input type="text" class="form-control" name="title" value="{{$product_sections->title}}">
                        </div>
                        <div class="mb-3">
                            <label>Description</label>
                            <input type="text" class="form-control" name="desp" value="{{$product_sections->desp}}">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Update Info</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection