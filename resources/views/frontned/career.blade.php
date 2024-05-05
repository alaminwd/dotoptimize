@extends('frontned.master')
@php
$seo = App\Models\CareerSeo::where('id', 1)->get();
@endphp
@section('title')
    <meta name="title" content="{{$seo->first()->title }}">
    <meta name="description" content="{{$seo->first()->desp }}">
    <meta name="keyword" content="{{$seo->first()->tag }}">
    <title>{{$seo->first()->title }}</title>
    
    <meta property="og:image" content="{{asset('upload/career_seo_img')}}/{{$seo->first()->image }}">
     <link rel="image_src" href="{{asset('upload/career_seo_img')}}/{{$seo->first()->image }}" />
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
                    <h2>Careers</h2>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- ===================================
        Careers page content
=======================================-->
{{-- <section id="project-area-four">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="careers_content">
                    <span>Case Studies</span>
                    <h2>We’ve Done Lot’s Of Work, Let’s
                        Check Some From Here</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="veiw_all ">
                    <a href="{{route('project')}}" >See All Projects</a>
                </div>
            </div>
        </div>
    </div>
</section> --}}
<section id="blog_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
            <div class="section_title">
                <p class="blog_sub_title">NEWS & BLOGS</p>
                <h2 class="title">Our Latest Updates</h2>
            </div>
            </div>
        </div>
        <div class="row ">
            @foreach ($careers as $career)
            <div class="col-lg-4 col-md-6">
                <div class="blog_item">
                    <div class="blog-post-thumb-two">
                        <a class="blog_img" href="{{route('post.details',$career->id)}}"><img src="{{asset('upload/career')}}/{{$career->image}}" class="w-100 img-fluid" alt=""></a>
                        {{-- <a href="" class="tag"> {{$career->category_name}} </a> --}}
                    </div>
                    <div class="blog-post-content">
                        <h2><a href="{{route('post.details',$career->id)}}">{{$career->title}}</a></h2>
                        <p>{{substr($career->desp, 0, 175)}}...</p>
                        <div class="blog_footer_content">
                            <ul>
                                <li><i class="fa-solid fa-calendar-days"></i>{{$career->created_at->format('Y M d')}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection