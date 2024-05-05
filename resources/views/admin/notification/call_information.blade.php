@extends('layouts.dashboard')

@section('content')
    <div class="container ">
        <div class="row mt-5">
            <div class="col-lg-6 ">
                <div class="card ">
                    <div class="card-header">
                        <h3>update call info</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($infos as $info)
                        <form action="{{route('update.call.info')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label >sub title</label>
                                <input type="text" class="form-control" name="sub_title" value="{{$info->sub_title}}"> 
                                <input type="hidden" class="form-control" name="id" value="{{$info->id}}"> 
                            </div>
                            <div class="mb-3">
                                <label >title</label>
                                <input type="text" class="form-control" name="title" value="{{$info->title}}"> 
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-info">Save</button> 
                            </div>
                            
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection