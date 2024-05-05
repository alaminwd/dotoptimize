@extends('frontned.master')
@php
$seo = App\Models\ProductSeo::where('id', 1)->get();
@endphp
@section('title')
    <meta name="title" content="{{$seo->first()->title }}">
    <meta name="description" content="{{$seo->first()->desp }}">
    <meta name="keyword" content="{{$seo->first()->tag }}">
    <title>{{$seo->first()->title }}</title>
    
     <meta property="og:image" content="{{asset('upload/product_seo_img')}}/{{$seo->first()->image }}">
     <link rel="image_src" href="{{asset('upload/product_seo_img')}}/{{$seo->first()->image }}" />
@endsection

@section('content')
    <!-- =================================
    Banner Part Start 
======================================-->
<section id="banner_two">
    <div class="shap_img">
        <img class="first_shap" src="{{asset('frontend/')}}images/breadcrumb-shape01.png" alt="">
        <img class="second_shap" src="{{asset('frontend/')}}images/breadcrumb-shape02.png" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="breadcrumb">
                    <h2>Our Product</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- =================================
        Completed Project part
======================================-->
<section id="complete_project">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
               <div class="section_title">
                    <span class="sub_title">Completed Project</span>
                    @foreach ($project_title as $title )
                        <h2 class="title">{{$title->title}}</h2>
                    @endforeach
               </div>
            </div>
            <div class="col-lg-6">
                <div class="project_content_top">
                    @foreach ($project_title as $desp )
                        <p>{{$desp->desp}}</p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($projects as $project)
            <div class="col-lg-4 col-md-6">
                <div class="project_item">
                    <div class="project_gallery_img">
                        <img src="{{asset('upload/product')}}/{{$project->image}}" class="w-100 img-fluid" alt="">   
                    </div>
                    <div class="overlay">
                        <div class="overlay_content">
                            <h2><a href="{{route('single.product', $project->id)}}">{{$project->title}}</a></h2>
                            <p>{{$project->short_desp}}</p>
                            <a class="link-btn" href="{{route('single.product', $project->id)}}"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{$projects->links()}}
        </div>
    </div>
</section>



@endsection

