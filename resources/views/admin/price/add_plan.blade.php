@extends('layouts.dashboard')

@section('content')
    @can('pricing_plan')
    <div class="row mt-3">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Plan List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Plan Name</th>
                            <th>Price</th>
                            <th>Popular</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($plans as $plan)
                            <tr>
                                <td>{{$plan->plan_name}}</td>
                                <td>&#2547;{{$plan->price}}</td>
                                <td>
                                    <a href="{{route('plan.status', $plan->id)}}" class="btn btn-{{$plan->status==1?'success':'light'}}">{{$plan->status==1?'Active':'Deactive'}}</a>
                                </td>
                                <td>
                                    <div class="dropdown mb-3">
                                        <a href="javascript:void(0)" class="more-button" data-toggle="dropdown" aria-expanded="false">
                                            <svg width="6" height="26" viewBox="0 0 6 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 3C6 4.65685 4.65685 6 3 6C1.34315 6 0 4.65685 0 3C0 1.34315 1.34315 0 3 0C4.65685 0 6 1.34315 6 3Z" fill="#585858"></path>
                                                <path d="M6 13C6 14.6569 4.65685 16 3 16C1.34315 16 0 14.6569 0 13C0 11.3431 1.34315 10 3 10C4.65685 10 6 11.3431 6 13Z" fill="#585858"></path>
                                                <path d="M6 23C6 24.6569 4.65685 26 3 26C1.34315 26 0 24.6569 0 23C0 21.3431 1.34315 20 3 20C4.65685 20 6 21.3431 6 23Z" fill="#585858"></path>
                                            </svg>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{route('plan.features', $plan->id)}}" class="dropdown-item">Add features</a>
                                            <a href="{{route('plan.edit', $plan->id)}}" class="dropdown-item">Edit</a>
                                            <a href="{{route('plan.delete', $plan->id)}}" class="dropdown-item">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Pricing plan</h3>
                </div>
                @if (session('plan'))
                    <div class="alert alert-success">{{session('plan')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('plan.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Plane Name</label>
                            <input type="text" class="form-control" name="plan_name">
                            @error('plan_name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Price</label>
                            <input type="number" class="form-control" name="price">
                            @error('price')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Add Plan</button>
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