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
                    <h2>Testimonials</h2>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- ======================================
        Testimonial Part  Start
==========================================-->
<section id="testimonial_single_page">
    <div class="container">
        <div class="row">
           <div class="col-lg-4 ms-auto">
            <img src="{{asset('upload/testimonial')}}/{{$content_test->image}}" class="w-100 img-fluid" alt="">
           </div>
                <div class="col-lg-6">
                    <div class="section_title">
                        <p class="sub_title">{{$content_test->sub_title}}</p>
                        <h2 class="title">{{$content_test->title}}</h2>
                    </div>
                <div class="testimonial_single">
                    @foreach ($reviews as $review)
                    <div class="testimonial_item">
                        <div class="rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="testimonial_content">{{$review->comment}}</p>
                        <div class="testimonial-avatar">
                            <div class="avatar-thumb">
                                <img src="{{asset('upload/review')}}/{{$review->logo}}" alt="Nafi">
                            </div>
                            <div class="avatar-info">
                                <h2 class="title">{{$review->name}}</h2><span>{{$review->profession}}</span>
                            </div>
                        </div> 
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

@endsection