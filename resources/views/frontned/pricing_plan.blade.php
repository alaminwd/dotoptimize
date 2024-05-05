@extends('frontned.master')

@section('content')
    <!-- =================================
    Banner Part Start 
======================================-->
<section id="banner_two">
    <div class="shap_img">

        <img class="first_shap" src="{{asset('frontend/images/breadcrumb-shape01.png')}}" alt="">
        <img class="second_shap" src="{{asset('frontend/images/breadcrumb-shape02.png')}}" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="breadcrumb">
                    <h2>Pricing</h2>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ========================================
        Pricing Area Part
==========================================-->
<section id="pricing-ara" class="single_pricing">
    <div class="container">
        <div class="row mb-5 mt-5">
            <div class="col-lg-6">
                <div class="top_header">
                    <span>FLEXIBLE PRICING PLAN</span>
                    <h2>We’ve offered the best pricing for you</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="top_content">
                    <p>Ever Find Yourself Staring At Your Computer Screen A Good Consulting Slogan To Come To Mind? Oftentimes.</p>
                </div>
            </div>
        </div>
            <div class="row">
                @foreach ($plans as $project_plan)
                <div class="col-lg-4 m-auto">                 
                    <div class="cards mb-4">
                        <div class="card">
    
                            <div class="card-header price_head text-center">
                                @if ($project_plan->status==1)
                                <span class="popular">{{$project_plan->status==1?'Popular':''}}</span>
                                @endif
                                <h4 class="pack">{{$project_plan->plan_name}}</h4>
                                <h4 class="month price bottom-bar">&#2547;{{$project_plan->price}} </h4>
                               
                            </div>
                            <div class="card-body">
                                <ul>
                                    @foreach (App\Models\Feature::where('plan_id', $project_plan->id)->get() as $features)
                                    <li><i class="fa-solid fa-check text-primary"></i>{{$features->features}}</li>
                                    @endforeach
                                </ul>
                                <a href="{{route('cart', $project_plan->id)}}" class="btn">Get The Plan Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
    </div>
</section>
@endsection

@section('footer_script')
    <script>
         @if(Session::has('success'))
                toastr.options =
                {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                }
                        toastr.success("{!! session('success') !!}");
                @endif
    </script>
@endsection

