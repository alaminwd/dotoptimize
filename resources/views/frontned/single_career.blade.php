@extends('frontned.master')
@php
$seo = App\Models\CareerJobField::where('id', 1)->get();
@endphp
@section('title')
    <meta name="title" content="{{$seo->first()->title }}">
    <meta name="description" content="{{$seo->first()->desp }}">
    <meta name="keyword" content="{{$seo->first()->tag }}">
    <title>{{$seo->first()->title }}</title>
    
    <meta property="og:image" content="{{asset('upload/career')}}/{{$seo->first()->image }}">
     <link rel="image_src" href="{{asset('upload/career')}}/{{$seo->first()->image }}" />
@endsection

@section('content')
<section id="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="blog-details-img">
                    <img src="{{asset('upload/career')}}/{{$careers_info->image}}" height="200"  class="w-100 img-fluid" alt="">
                </div>
                <div class="blog-details-content">
                    <ul>
                        <li><i class="far fa-calendar"></i>{{$careers_info->created_at->format('Y M d')}}</li>
                    </ul>
                    <h2><a href="#">{{$careers_info->title}}</a></h2>
                    <p>{{$careers_info->desp}}...</p>
                </div>
            </div>
           <div class="col-lg-5">
            <section id="request_call" style="background: transparent ">
                <form action="{{route('upload.cv')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <input type="text" name="name" placeholder="Name*" class="form-control">
                                @error('name')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <input type="email" name="email" placeholder="E-mail*" class="form-control">
                                @error('email')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <input type="number" name="phone" placeholder="Phone*" class="form-control">
                                @error('phone')
                                     <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <input type="file" class="form-control" name="cv" class="form-control"> 
                                    @error('cv')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        <div class="col-lg-12">
                            <div class="mt-4">
                                <button type="submit" class="btn w-100">Send Message</button>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            
           </div>
        </div>
    </div>
</section>
@endsection