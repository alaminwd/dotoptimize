@extends('frontned.master')
@section('title')
<meta name="title" content="{{$project_info->title}}">
<meta name="description" content="{{$project_info->short_desp}}">
<meta name="keyword" content="{{$project_info->keyword}}">
<title>{{$project_info->title}}</title>

<meta property="og:image" content="{{asset('upload/project')}}/{{$project_info->image }}">
     <link rel="image_src" href="{{asset('upload/project')}}/{{$project_info->image }}" />
@endsection
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
                    <h2>{{$project_info->title}}</h2>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- ================================
    Single Product Details
====================================-->
<section id="product-details-part">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="product-preview-img">
                    <img src="{{asset('upload/project')}}/{{$project_info->image}}" class="w-100 img-fluid" alt="">
                </div>
                <div class="product-left-content">
                    <h3>{{$project_info->title}}</h3>
                  
                    <div class="ck-content">
                       {!! $project_info->long_desp!!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-8">
                <div class="right-content">
                    <div class="product_title">
                        <h3>Project Information</h3>
                    </div>
                        <ul>
                            <li><span>Client:</span>{{$project_info->client}}</li>
                            <li><span >Date:</span>{{$project_info->created_at->format('M d, Y')}} </li>
                            <li><span>Author:</span> {{$project_info->author}}</li>
                            <li><span>Place:</span> {{$project_info->place}}</li>
                           <li class="social"><span>Share:</span>
                                <div class="share_icon">
                                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                    <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ========================================
        Pricing Area Part
==========================================-->
<section id="pricing-ara">
    @if ($project_plans->count())
    <div class="container">
        <div class="row">
            @foreach ($project_plans as $project_plan)
            <div class="col-lg-4 m-auto">                 
                <div class="cards">
                    <div class="card">
                        <div class="card-header price_head">
                            <h4 class="pack">{{$project_plan->rel_to_plan->plan_name}}</h4>
                            <h4 class="month price bottom-bar">&#2547;{{$project_plan->rel_to_plan->price}} </h4>
                        </div>
                        <div class="card-body">
                            <ul>
                                @foreach (App\Models\Feature::where('plan_id', $project_plan->plan_id)->get() as $features)
                                <li><i class="fa-solid fa-check text-primary"></i>{{$features->features}}</li>
                                @endforeach
                            </ul>
                            <a href="{{route('cart', $project_plan->rel_to_plan->id)}}" class="btn">Get The Plan Now</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
       
    </div>
    @endif
</section>

<!-- =================================
    Brand Item Part 
=====================================-->
<section id="brand_part" class="pb-5">
    <div class="container">
        <div class="row">
            <div class="brand-slider">
                    <div class="brand-item d-flex">
                        @foreach ($clients as $client)
                        <div class="brand-img">
                            <a href="{{$client->company_link}}"><img class="w-100 img-fluid" src="{{asset('upload/client')}}/{{$client->company_logo}}" alt=""></a>
                        </div>
                        @endforeach
                    </div>
               
            </div>
        </div>
    </div>
</section>
            
@endsection