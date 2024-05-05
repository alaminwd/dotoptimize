@extends('frontned.master')

@section('title')
    <meta name="title" content="{{$blog_info->title}}">
    <meta name="description" content="{{$blog_info->desp}}">
    <meta name="keyword" content="
    @foreach (App\Models\BlogTag::where('blog_id', $blog_info->id)->get() as $tag)
        {{$tag->rel_to_tag->tag_name}}
    @endforeach
    ">
    <title>{{$blog_info->title}}</title>
    
    <meta property="og:image" content="{{asset('upload/blog')}}/{{$blog_info->image }}">
     <link rel="image_src" href="{{asset('upload/blog')}}/{{$blog_info->image }}" />
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
            <div class="col-lg-12 m-auto">
                <div class="breadcrumb">
                    <h2>{{$blog_info->title}}</h2>
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
                <div class="blog-details-img">
                    <img src="{{asset('upload/blog')}}/{{$blog_info->image}}" class="w-100 img-fluid" alt="">
                </div>
                <div class="blog-details-content">
                    <ul>
                        <li><i class="far fa-calendar"></i>{{$blog_info->created_at->format('Y M d')}}</li>
                        <li>
                            <i class="fas fa-tags"></i>
                            @foreach (App\Models\BlogTag::where('blog_id', $blog_info->id)->get() as $tag)
                              <a href="#">{{$tag->rel_to_tag->tag_name}},</a>
                            @endforeach
                        </li>
                    </ul>
                    <p>{{$blog_info->desp}}</p>
                    
                     {!!$blog_info->long_desp !!}
                    <div class="bottom-content">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <div class="post-tags">
                                    <h5>Tags :</h5>
                                    <ul>
                                        @foreach (App\Models\BlogTag::where('blog_id', $blog_info->id)->get() as $tag)
                                        <li><a href="{{route('tag.single.blog',$tag->id)}}">{{$tag->rel_to_tag->tag_name}}</a></li>
                                       
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <div class="blog-post-share">
                                    <h5>Share:</h5>
                                    <ul>
                                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li><a href="#"></a><i class="fa-brands fa-twitter"></i></li>
                                        <li><a href="#"></a><i class="fa-brands fa-linkedin-in"></i></li>
                                        <li><a href="#"></a><i class="fa-brands fa-pinterest-p"></i></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="comment" style="padding-bottom:20px">
                            <form action="{{route('comment.store')}}" method="post">
                                @csrf
                                <input type="hidden" name="blog_id" value="{{$blog_info->id}}">
                                <input type="hidden" name="name" value="{{Auth::guard('customerlogin')->id()?Auth::guard('customerlogin')->user()->name :'' }}">
                                <input type="text" required name="comment" class="form-control" style="width: 70%; display:inline; height:45px; margin-right: 10px; margin-bottom: 10px;">
                                
                                <button style="font-size:18px; font-weight:600; height:45px; margin-top:-3px; letter-spacing: 1px;" type="submit" class="btn btn-dark">comment</button>
                            </form>
                        </div>
                        @foreach ($comments as $comment)
                        <div class="row mb-3">
                            <div class="col-lg-12">
                              <strong style="color: #0049dc">{{$comment->name}}:</strong> {{$comment->comment}}
                            </div>
                            @if ($comment->reply)
                            <div class="col-lg-12 mt-3">
                                <strong style="color: #0049dc">Admin:</strong> {{$comment->reply}}
                              </div>
                            @endif
                        </div>
                        @endforeach
                        {{$comments->links()}}
                    </div>
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