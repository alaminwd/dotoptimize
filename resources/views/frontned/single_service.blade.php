@extends('frontned.master')
@section('title')
    <meta name="title" content="{{$single_service->title}}">
    <meta name="description" content="{{$single_service->short_desp}}">
    <meta name="keyword" content="{{$single_service->keyword}}">
    <title>{{$single_service->title}}</title>
    
    <meta property="og:image" content="{{asset('upload/service')}}/{{$single_service->image }}">
     <link rel="image_src" href="{{asset('upload/service')}}/{{$single_service->image }}" />
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
                    <h2>{{$single_service->title}}</h2>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ====================================
        Service Details Part
=======================================-->
<section id="service-details-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="service-sidebar">
                    <div class="service-cart">
                        <ul>
                            @foreach (App\Models\Service::all(); as $service)
                            <li class="{{$service->id==$single_service->id?'active':''}}"><a href="{{route('single.service', $service->id)}}" class="nav-link">{{substr($service->title, 0, 20)}}...<i class="fa-solid fa-arrow-right"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="help-box">
                        <h4>You Need Any Help Contact With Us</h4>
                        <a href="#"><i class="fa-solid fa-phone"></i>  {{$footer_info->phone}} </a>
                    </div>
                    <div class="freequote" id="freequote">
                        <h4>Get A Free Quote</h4>
                        <form action="{{route('quote.store')}}" method="POSt">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="name" placeholder="Your Name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" placeholder="Email-Address" class="form-control">
                            </div>
                            <div class="mb-3">
                                <textarea name="desp" class="form-control" style="resize: none; height: 100px;" id="" cols="30" rows="10" placeholder="Type Your Message"></textarea>
                            </div>
                            <div class="mb-3">
                               <button type="submit" class="btn">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="service-right-content">
                    <div class="gallery-img">
                        <img src="{{asset('upload/service')}}/{{$single_service->image}}" class="w-100 img-fluid" alt="">
                    </div>
                    <div class="service-info-area">
                        <h2>{{$single_service->short_desp}}</h2>
                        {!!$single_service->long_desp!!}
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
                            <h4 class="month price bottom-bar">&#2547;{{$project_plan->rel_to_plan->price}}</h4>
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

                @if(Session::has('error'))
                toastr.options =
                {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                }
                        toastr.error("{!! session('error') !!}");
                @endif
  </script>
     
@endsection