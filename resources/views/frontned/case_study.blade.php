@extends('frontned.master')
@php
$seo = App\Models\CaseStudiesSeo::where('id', 1)->get();
@endphp
@section('title')
    <meta name="title" content="{{$seo->first()->title }}">
    <meta name="description" content="{{$seo->first()->desp }}">
    <meta name="keyword" content="{{$seo->first()->tag }}">
    <title>{{$seo->first()->title }}</title>
    <meta property="og:image" content="{{asset('upload/CaseStudiesSeo')}}/{{$seo->first()->image }}">
     <link rel="image_src" href="{{asset('upload/CaseStudiesSeo')}}/{{$seo->first()->image }}" />
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
                    <h2>Case Studies</h2>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- =================================
        Completed Project part
======================================-->
<section id="complete_project" class="case_select">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
               <div class="section_title">
                    <span class="sub_title">What We Do for you</span>
                    <h2 class="title" style="line-height: 45px;">We Can Inspire and Offer Different Services</h2>
               </div>
            </div>
            <div class="col-lg-6">
                <div class="project_content_top" style="text-align: right">
                    <a class="ser" href="{{route('service')}}">See All Service</a>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($services as $service)
            <div class="col-lg-3 col-md-6 col-sm-10 m-auto">
                <div class="service_item case_header">
                    <div class="contetn_header">
                        <div class="header_icon">
                            <i class="{{$service->icon}}"></i>
                        </div>
                    </div>
                    <div class="footer_content">
                        <a href="{{route('single.service', $service->id)}}">{{$service->title}}</a>
                        <p>{{substr($service->short_desp, 0, 77)}}...</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection