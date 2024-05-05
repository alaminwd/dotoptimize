@extends('frontned.master')
@php
$seo = App\Models\PrivacyPolicySeo::where('id', 1)->get();
@endphp
@section('title')
    <meta name="title" content="{{$seo->first()->title }}">
    <meta name="description" content="{{$seo->first()->desp }}">
    <meta name="keyword" content="{{$seo->first()->tag }}">
    <title>{{$seo->first()->title }}</title>
    
    <meta property="og:image" content="{{asset('upload/privacy_policy_seo')}}/{{$seo->first()->image }}">
     <link rel="image_src" href="{{asset('upload/privacy_policy_seo')}}/{{$seo->first()->image }}" />
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
                    <h2>Privacy Policy</h2>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- ===================================
        Careers page content
=======================================-->
<section id="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-details-content">
                    
                     {!!$policy_info->desp !!}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection