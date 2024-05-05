@extends('frontned.master')
@php
$seo = App\Models\ServiceSeo::where('id', 1)->get();
@endphp
@section('title')
    <meta name="title" content="{{$seo->first()->title }}">
    <meta name="description" content="{{$seo->first()->desp }}">
    <meta name="keyword" content="{{$seo->first()->tag }}">
    <title>{{$seo->first()->title }}</title>
    
    <meta property="og:image" content="{{asset('upload/service_seo_img')}}/{{$seo->first()->image }}">
     <link rel="image_src" href="{{asset('upload/service_seo_img')}}/{{$seo->first()->image }}" />
    
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
            <div class="col-lg-6 m-auto">
                <div class="breadcrumb">
                    <h2>Services</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ==================================
        Service Part Start 
======================================-->
<section id="service_part">
    <div class="container">
        <div class="row">
           <div class="col-lg-5 m-auto">
            <div class="title">
                <h2>Our Services</h2>
                <p>We Have Extensive Experience Building Enterprise-Grade Applications Using Modern Technologies.</p>
            </div>
           </div>
        </div>
        <div class="row">
            @foreach ($services as $service)
            <div class="col-lg-4 col-md-6 col-sm-10 m-auto">
                <div class="service_item">
                    <div class="contetn_header">
                        <div class="header_icon">
                            <i class="{{$service->icon}}"></i>
                        </div>
                        <h3>{{$service->title}}</h3>
                    </div>
                    <div class="service_gallery_img">
                        <img src="{{asset('upload/service')}}/{{$service->image}}" class="w-100 img-fluid" alt="">
                        <a href="{{route('single.service', $service->id)}}">Veiw Details  <i class="fa-solid fa-chevron-right"></i></a>
                    </div>
                    <div class="footer_content">
                        <p>{{substr($service->short_desp, 0, 77)}}...</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection