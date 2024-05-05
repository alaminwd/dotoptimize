@extends('frontned.master')
@php
$seo = App\Models\HomeSeo::where('id', 1)->get();
@endphp
@section('title')
    <meta name="title" content="{{$seo->first()->title }}">
    <meta name="description" content="{{$seo->first()->desp }}">
    <meta name="keyword" content="{{$seo->first()->tag }}">
    <title>{{$seo->first()->title }}</title>
    
    <meta property="og:image" content="{{asset('upload/home_seo_img')}}/{{$seo->first()->image }}">
     <link rel="image_src" href="{{asset('upload/home_seo_img')}}/{{$seo->first()->image }}" />
   
@endsection


@section('content')
    <!-- =================================
    Banner Part Start 
======================================-->
<section id="banner_part">
    <div class="main_ball d-none d-lg-block">
        <div class="one"></div>
        <div class="two"></div>
        <div class="three"></div>
        <div class="foure"></div>
        <div class="five"></div>
        <div class="six"></div>
        <div class="seven"></div>
        <div class="eight"></div>
        <div class="nine"></div>
        <div class="ten"></div>
        <div class="eleven"></div>
        <div class="twelve"></div>
        <div class="thirteen"></div>
        <div class="fourteen"></div>
        <div class="fifteen"></div>
        <div class="sixteen"></div>
        <div class="seventeen"></div>
        <div class="eighteen"></div>
        <div class="nineteen"></div>
        <div class="twenty"></div>
        <div class="twenty_one"></div>
        <div class="twenty_two"></div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-10 m-auto order-lg-2">
                <div class="banner_img wow fadeInRight" data-wow-duration="1.6s" data-wow-delay=".6s">
                   <video class="w-100 img-fluid" autoplay muted loop src="{{asset('upload/banner')}}/{{$banner_info->image}}"></video>
                </div>
            </div>
            <div class="col-lg-5 m-auto">
                <div class="banner-content">
                    <h1 class="wow fadeInLeft" data-wow-duration="1.6s" data-wow-delay=".2s">{{$banner_info->title}}</h1>
                    <p class="wow fadeInLeft" data-wow-duration="1.6s" data-wow-delay=".4s">{{$banner_info->desp}}</p>
                </div>
                <form class="banner_form wow fadeInLeft" data-wow-duration="1.6s" data-wow-delay=".6s" action="{{route('subscribe.banner')}}" method="POST">
                    @csrf
                    <input type="email" name="email" class="form-control" placeholder="Email Address">
                    <button type="submit"><i class="fa-solid fa-arrow-right"></i></button>
                </form>
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

<!-- =================================
    Brand Item Part 
=====================================-->
<section id="brand_part">
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


<!-- ====================================
    Over View Part start 
========================================-->
<section id="over_view">
    <div class="overview_shap">
        <img src="{{asset('frontend/images/shape02.png')}}" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-10 m-auto">
                <div class="over_view_img">
                    <img src="{{asset('upload/overview')}}/{{$over_view->main_img}}" class="d-block img-fluid" alt="">
                    <img src="{{asset('frontend/images/overview-img-shape.png')}}" alt="">
                    <img src="{{asset('upload/overview')}}/{{$over_view->site_img}}" class="fliud" alt="">
                    <div class="over_view_icon">
                        <i class="{{$over_view->icon}}"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-10 m-auto">
                <div class="over_view_content">
                    <div class="section_title">
                        <span class="sub_title">Company Overview</span>
                        <h2 class="title">{{$over_view->title}}</h2>
                    </div>
                    <p class="overview_info">{{$over_view->desp}}</p>
                    <div class="overview_bottom_content">
                       <ul>
                            <li> <p>Best Award</p> </li>
                            <li> <p>Happy Clients</p> </li>
                       </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ====================================
    Over View Part start 
========================================-->

<section id="work_area" style="background: url({{asset('upload/work/'.$work_info->image)}})fixed ;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="work_area_content">
                    <div class="section_title">
                        <h2 class="title" style="text-transform: uppercase;">{{$work_info->title}}</h2>
                    </div>
                    <p>{{$work_info->desp}}</p>
                    <a  class="play-btn" target="_blank" href="{{$work_info->video_link}}"><i class="fas fa-play"></i> Watch Video</a>
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
                    <h2 class="title">{{$title->section_title}}</h2>
                    @endforeach
                   
               </div>
            </div>
            <div class="col-lg-6">
                <div class="project_content_top">
                    @foreach ($project_title as $desp )
                        <p>{{$desp->section_desp}}</p>
                    @endforeach
                  
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($projects as $project)
            <div class="col-lg-4 col-md-6">
                <div class="project_item">
                    <div class="project_gallery_img">
                        <img src="{{asset('upload/project')}}/{{$project->image}}" class="w-100 img-fluid" alt="">   
                    </div>
                    <div class="overlay">
                        <div class="overlay_content">
                            <h2><a href="{{route('single.project', $project->id)}}">{{$project->title}}</a></h2>
                            <p>{{$project->desp}}</p>
                            <a class="link-btn" href="{{route('single.project', $project->id)}}"><i class="fas fa-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ====================================
        Contact Part 
========================================-->
<section id="contact_area">
    <div class="container" style="background: url({{asset('frontend/images/cta-bg.png')}}) no-repeat center; background-size: cover; border-radius: 10px; padding: 70px 0;">
        <div class="row">
            <div class="col-lg-9">
                <div class="text_contact">
                    <div class="info">
                        <div class="icon">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="content">
                            <span>{{$info->sub_title}}</span>
                            <a href="tel:{{$footer_info->phone}}" dir="ltr">{{$footer_info->phone}}</a>
                        </div>
                    </div>
                    <h2 class="title">{{$info->title}}</h2>
                </div>
            </div>
            <div class="col-lg-3 m-auto">
                <div class="contact_btn text-center">
                    <a href="{{route('contact')}}" class="btn"> Contact Us <i class="fa-solid fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =====================================
        Our Team Part 
==========================================-->
<section id="team_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
               <div class="section_title">
                    <span class="sub_title">Expart People</span>
                    @foreach ($team_title as $title)
                       <h2 class="title">{{$title->section_title}}</h2>
                    @endforeach
                   
               </div>
            </div>
            <div class="col-lg-6">
                <div class="team_content_top">
                    @foreach ($team_title as $title)
                         <p>{{$title->section_desp}}</p>
                    @endforeach
                    
                </div>
            </div>
        </div>
        <div class="row team_slider">
            @foreach ($teams as $team)
            <div class="col-lg-3 col-md-6 m-auto">
                <div class="team_item">
                   <a href="{{route('single.member', $team->id)}}">
                    <img src="{{asset('upload/team')}}/{{$team->image}}" alt=""></a>
                    <div class="team_icon">
                        <ul>
                            @foreach (App\Models\MemberIcon::where('member_id', $team->id)->get() as $member_icon)
                            <li><a href="{{$member_icon->icon_link}}"><i class="{{$member_icon->icon}}"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="member_info">
                        <a href="{{route('single.member', $team->id)}}"><h3>{{$team->name}}</h3> </a>
                        <span>{{$team->role}}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


<!-- ======================================
        Testimonial Part  Start
==========================================-->
<section id="testimonial_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 m-auto">
            <div class="section_title">
                <p class="testimonial_sub_title">OUR TESTIMONIALS</p>
                <h2 class="title">What Customers Say’s About Our Gerow Services</h2>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="testimonial_main d-flex">
                @foreach ($reviews as $review)
                <div class="col-lg-6">
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
                                <h2 class="title">{{$review->name}}</h2><span style="color: #334770;">{{$review->profession}}</span>
                            </div>
                        </div> 
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>


<!-- ====================================
     Blog Part Start 
=======================================-->
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
            @foreach ($blogs as $blog)
            <div class="col-lg-4 col-md-6">
                <div class="blog_item">
                    <div class="blog-post-thumb-two">
                        <a class="blog_img" href="{{route('single.blog',$blog->id)}}"><img src="{{asset('upload/blog')}}/{{$blog->image}}" class="w-100 img-fluid" alt=""></a>
                        <a href="{{route('single.blog',$blog->id)}}" class="tag"> {{$blog->rel_to_category->category_name}} </a>
                    </div>
                    <div class="blog-post-content">
                        <h2><a href="{{route('single.blog',$blog->id)}}">{{$blog->title}}</a></h2>
                        <p>{{substr($blog->desp, 0, 175)}}...</p>
                        <div class="blog_footer_content">
                            <ul>
                                <li><i class="fa-solid fa-calendar-days"></i>{{$blog->created_at->format('Y M d')}}</li>
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

