@extends('layouts.dashboard')

@section('content')
    @can('company_overview')
    <div class="row mt-4">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Company Overview</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('overview.update')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label >Title</label>
                            <input type="hidden"  name="overview_id" value="{{$overviwe_info->id}}">
                            <input type="text" class="form-control" name="title" value="{{$overviwe_info->title}}">
                        </div>
                        <div class="mb-3">
                            <label >Description</label>
                            <textarea name="desp" class="form-control">{{$overviwe_info->desp}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label >Main Image</label>
                            <input type="file" name="main_img" class="form-control m-t-xxs" id="exampleInputEmail1"   onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="form-group">
                            <img src="" id="blah" alt="" width="100px">
                        </div>
                        <div class="mb-3">
                            <label >Site Image</label>
                            <input type="file" name="site_img" class="form-control m-t-xxs" id="exampleInputEmail1"   onchange="document.getElementById('bah').src = window.URL.createObjectURL(this.files[0])">
                        </div>
                        <div class="form-group">
                            <img src="" id="bah" alt="" width="100px">
                        </div>
                        <div class="mb-3">
                            <label>Select Icon</label>
                            <input type="text" class="form-control" name="icon" id="icon" value="{{$overviwe_info->icon}}">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Update Overview</button>
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