@extends('layouts.dashboard')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="row">
                @foreach ($sevice_plans as $plan)
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 style="width: 100%; display: flex; align-items: center; justify-content: space-between;">{{$plan->rel_to_plan->plan_name}}<a href="{{route('service.price.delete', $plan->id)}}" class="btn btn-danger float-right">Delete</a></h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>SL</th>
                                    <th>features</th>
                                </tr>
                                
                                @php
                                  $features = App\Models\Feature::where('plan_id', $plan->plan_id)->get();
                                @endphp
                                @foreach ($features as $sl=>$feature)
                                <tr>
                                    <td>{{$sl+1}}</td>
                                    <td>{{$feature->features}}</td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Service Plan</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('add.service.plan')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label> Add Price</label>
                            <input type="hidden" name="service_id" value="{{$ser_info->id}}">
                            <select name="plan_id" class="form-control">
                                <option value="">--select sny--</option>
                                @foreach ($plans as $plan)
                                <option value="{{$plan->id}}">{{$plan->plan_name}}</option>
                                @endforeach
                            </select>
                            @error('plan_id')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-info">Add Price</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection