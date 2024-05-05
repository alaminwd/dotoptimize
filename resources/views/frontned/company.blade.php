@extends('frontned.master')
@php
$seo = App\Models\CompanySeo::where('id', 1)->get();
@endphp
@section('title')
    <meta name="title" content="{{$seo->first()->title }}">
    <meta name="description" content="{{$seo->first()->desp }}">
    <meta name="keyword" content="{{$seo->first()->tag }}">
    <title>{{$seo->first()->title }}</title>
    
    <meta property="og:image" content="{{asset('upload/company_seo_img')}}/{{$seo->first()->image }}">
     <link rel="image_src" href="{{asset('upload/company_seo_img')}}/{{$seo->first()->image }}" />
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
                    <h2>Company</h2>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===============================
            About Part Start
====================================-->
<section id="about_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="about_img">
                    <img  src="{{asset('upload/about')}}/{{$about_info->image}}" class="img-fluid main_img" alt="">
                    <img class="floating_img" src="{{asset('frontend/images/about-img04.png')}}" alt="">
                    <img class="animate_img" src="{{asset('frontend/images/banner-shape02.png')}}" alt="">
                    <div class="overlay">
                        <h2>{{$about_info->experience}}</h2>
                        <h4>Years Of Experience</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about_content">
                    <span class="sub_title">Get to Know Us</span>
                    <h2 class="mt-4">{{$about_info->title}}</h2>
                    <p>{{$about_info->desp}}</p>

                   <div class="row">
                        <div class="col-lg-5 col-md-6">
                            <div class="about_success">
                                <i class="fa-solid fa-trophy"></i>
                                <h2 class="count"><span class="data-count">{{$about_info->award}}</span>+</h2>
                                <p>Best Award</p>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-6 ">
                            <div class="about_success">
                                <i class="far fa-smile"></i>
                                <h2 class="count"><span class="data-count">{{$about_info->client}}</span>+</h2>
                                <p>Happy Clients</p>
                            </div>
                        </div>
                   </div>
            </div>
        </div>
    </div>
</section>

<!-- ====================================
    Over View Part start 
========================================-->

<section id="work_area" style="background: url({{asset('frontend/images/overview.jpg')}} ) fixed ;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="work_area_content">
                    <div class="section_title">
                        <h2 class="title" style="text-transform: uppercase;">{{$work_info->title}}</h2>
                    </div>
                    <p>{{$work_info->desp}}</p>
                    <a  class="play-btn"><i class="fas fa-play"></i> Watch Video</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="progressbar-tooltip">
					<p class="fw-bold pt-4 pb-4">WHY WE ARE THE BEST</p>
                    @foreach ($skills as $skill)
					<div class="ab-progress" data-progress data-tooltip="true" data-value="{{$skill->percent}}" data-title="{{$skill->skill}}"></div>
                    @endforeach
				</div>
            </div>
        </div>
    </div>
</section>

@endsection