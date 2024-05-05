@extends('layouts.dashboard')

@section('content')
    <div class="row mt-4">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Update Pricing plan</h3>
                </div>
                @if (session('plan'))
                    <div class="alert alert-success">{{session('plan')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('plan.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Plane Name</label>
                            <input type="hidden" name="plan_id" value="{{$plan_info->id}}">
                            <input type="text" class="form-control" name="plan_name" value="{{$plan_info->plan_name}}">
                        </div>
                        <div class="mb-3">
                            <label>Price</label>
                            <input type="number" class="form-control" name="price" value="{{$plan_info->price}}">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Update Plan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection