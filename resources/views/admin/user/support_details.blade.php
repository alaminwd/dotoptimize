@extends('layouts.dashboard')

@section('content')
    <div class="row mt-5">
       <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Support Details</h3>
            </div>
            <div class="card-body">
                <form action="" method="">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" value="{{$support_details->rel_to_customer->name}}">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" value="{{$support_details->rel_to_customer->email}}">
                    </div>
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="number" class="form-control" value="{{$support_details->rel_to_customer->phone}}">
                    </div>
                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" class="form-control" value="{{$support_details->title}}">
                    </div>
                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="desp" class="form-control" style="resize: none; height: 100px; text-align:left" placeholder="Content*" cols="30" rows="10">
                            {{$support_details->desp}}
                        </textarea>
                    </div>
                    <div class="mb-4">
                        <a href="mailto:{{$support_details->rel_to_customer->email}}" class="btn btn-info">Message Reply</a>
                    </div>
                </form>
            </div>
        </div>
       </div>
    </div>
@endsection