@extends('layouts.dashboard')

@section('content')
    <div class="row mt-4">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Add Features</h3>
                </div>
                @if (session('plan'))
                    <div class="alert alert-success">{{session('plan')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('feature.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Features</label>
                            <input type="hidden" name="feature_id" value="{{$featrue_info->id}}">
                            <input type="text" class="form-control" name="features" value="{{$featrue_info->features}}">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Update Features</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection