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
            <div class="col-lg-12 m-auto">
                <div class="breadcrumb">
                    <h2>{{$category_info->category_name}}</h2>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- ==============================
    Blog Details Page
====================================-->
<section id="blog-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
              <div class="row">
                @php
                   $blog_infos =  App\models\Blog::where('category_id', $category_info->id)->get()
                @endphp
                @if ($blog_infos->count())
                @foreach ($blog_infos as $blog_info)   

                <div class="col-lg-6 mb-4">
                    <div class="blog_item">
                        <div class="blog-post-thumb-two">
                            <a class="blog_img" href="{{route('single.blog',$blog_info->id)}}"><img src="{{asset('upload/blog')}}/{{$blog_info->image}}" class="w-100 img-fluid" alt=""></a>
                            <a href="{{route('single.blog',$blog_info->id)}}" class="tag"> {{$blog_info->rel_to_category->category_name}} </a>
                        </div>
                        <div class="blog-post-content">
                            <h2><a href="{{route('single.blog',$blog_info->id)}}">{{$blog_info->title}}</a></h2>
                            <p>{{substr($blog_info->desp, 0, 175)}}...</p>
                            <div class="blog_footer_content">
                                <ul>
                                    <li><i class="fa-solid fa-calendar-days"></i>{{$blog_info->created_at->format('Y M d')}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

                @else
                <div class="col-lg-10 m-auto">
                    <h3 class="text-center" style="color: #00194c; font-size: 40px; font-weight:600;">Ops! No results found</h3>
                    <p class="text-center" style="color: #334770; margin-top: 20px; font-size: 18px; font-weight: 500;">We couldn’t find what you searched for. Try searching again or <a href="{{route('blog')}}">Back Here</a></p>
                </div>
                @endif
              </div>
            </div>
            <div class="col-lg-4">
                <div class="search_bar">
                    <div class="form">
                        <input id="search_input" type="text" placeholder="Enter keyword">
                        <button class="search-btn " id="search_btn"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="blog_left_content">
                    <div class="category">
                        <div class="blog_title">
                            <h3>Category</h3>
                        </div>
                        <ul>
                            @foreach ($categories as $category)
                            @php
                               $blog_category = App\Models\Blog::where('category_id', $category->id)->get();
                            @endphp
                            <li><a href="{{route('category.blog', $category->id)}}"> {{$category->category_name}} <span>{{$blog_category->count()}}</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="recent_pst_section">
                        <div class="blog_title">
                            <h3>Recent Post</h3>
                        </div>
                        @foreach ($blogs as $blog)
                        <div class="post_item">
                            <div class="thumb">
                                <a href="{{route('single.blog', $blog->id)}}"><img src="{{asset('upload/blog')}}/{{$blog->image}}" alt=""></a>
                            </div>
                            <div class="content">
                                <span class="date"><i class="far fa-calendar"></i>{{$blog->created_at->format('Y M d')}}</span>
                                <h2>
                                    <a href="{{route('single.blog', $blog->id)}}">{{$blog->rel_to_category->category_name}}</a>
                                </h2>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="tags">
                        <div class="blog_title">
                            <h3>Tags</h3>
                        </div>
                        <ul>
                            @foreach ($tags as $tag)
                            <li><a href="{{route('tag.single.blog',$tag->id)}}">{{$tag->tag_name}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('footer_script')
<script>
    $('#search_btn').click(function(){
        var search_input = $('#search_input').val();
        var link = "{{ route('search') }}" + "?q=" + search_input;
        window.location.href = link;
    });
</script>
@endsection