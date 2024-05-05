@extends('layouts.dashboard')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Copyright Info</h3>
                </div>
                <div class="card-body">
                    @foreach ($copyright as $copy)
                    <form action="{{route('copyright.content.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Bkash User Name</label>
                            <input type="text" class="form-control" name="title" value="{{$copy->title}}">

                            <input type="hidden" name="id" value="{{$copy->id}}">
                            @error('title')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                           <button type="submit" class="btn btn-info">Save</button>
                        </div>
                    </form>   
                    @endforeach                
                </div>
            </div>
        </div>
    </div>
@endsection