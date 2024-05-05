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
            <div class="col-lg-6 m-auto">
                <div class="breadcrumb">
                    <h2>{{$team_info->name}}</h2>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- =======================================
        Team Profile Part 
==========================================-->

<section id="profiel-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="member-profile">
                    <div class="profile-img">
                        <img src="{{asset('upload/team')}}/{{$team_info->image}}" class="w-100 img-fluid" alt="">
                    </div>
                    <div class="member-contact-info">
                        <ul>
                            <li><i class="fa-solid fa-phone"></i> <a href="#">{{$team_info->phone}}</a></li>
                            <li><i class="fa-regular fa-message"></i> <a href="mailto:{{$team_info->email}}">{{$team_info->email}}
                            </a></li>
                            <li><i class="fa-solid fa-location-dot"></i> <a href="#">{{$team_info->address}}</a></li>
                        </ul>
                        <a class="btn" href="{{route('contact')}}">Get In Touch</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7" >
                <div class="profile-info">
                    <h2 class="title">{{$team_info->name}}</h2>
                    <span>{{$team_info->role}}</span>
                    <p>{{$team_info->short_desp}}</p>
                    <div class="team-skill">
                        <h3 class="title-two">My Expertise &amp; Skills</h3>
                        <p>{{$team_info->about}}</p>
                        <div class="progressbar-tooltip">
                            @foreach (App\Models\Teamskill::where('member_id', $team_info->id)->get() as $skill)
                            <div class="ab-progress" data-progress data-tooltip="true" data-value="{{$skill->percent}}" data-title="{{$skill->skill}}"></div>
                            @endforeach
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