
@extends('layouts.dashboard');


@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white ml-auto mr-auto">Product Info</h3>
            </div>
            <div class="card-body">
               <form>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="mb-3">
                            <label>Title</label>
                            <input readonly type="text" class="form-control" value="{{$projects_info->title}}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label>Short Description</label>
                            <input type="text" class="form-control" value="{{$projects_info->short_desp}}">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-3">
                            <label>Short Description</label>
                            <textarea readonly id="summernote">{{$projects_info->long_desp}}</textarea>
                        </div>
                    </div>
                </div>
               </form>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5">
    <div class="col-lg-8">
        <div class="row">
            @foreach ($project_plans as $plan)
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 style="width: 100%; display: flex; align-items: center; justify-content: space-between;">{{$plan->rel_to_plan->plan_name}}<a href="{{route('product.plan.delete', $plan->id)}}" class="btn btn-danger float-right">Delete</a></h3>
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
                <h3>Add Price</h3>
            </div>
            @if (session('plan'))
                <div class="alert alert-success">{{session('plan')}}</div>
            @endif
            <div class="card-body">
                <form action="{{route('product.plan.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Add Pricing Plan</label>
                        <input type="hidden" name="product_id" value="{{$projects_info->id}}">
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
                        <button class="btn btn-primary" type="submit">Add plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')

<script>
    $('#summernote').summernote();
</script>
@endsection 




