<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')

    <link rel="icon" href="{{asset('frontend/images/favicon.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('frontend/css/progressBar.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Roboto+Condensed:wght@400;500;600;700;800&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/flaticon.css')}}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{asset('frontend/css/slick.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
</head>
<body>
    
<!-- ================================= 
        Header part Start
====================================-->
<header>
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                @php
                  $footer =  App\Models\Footer::all();
                  foreach ($footer as $footer) {
                    $footers = $footer;
                  }
                @endphp
                <p><a><i class="fa-solid fa-location-dot"></i>{{$footers->top_address}}</a></p>
                <p><a href="mailto:{{$footers->email}}"><i class="fas fa-envelope"></i>{{$footers->email}}</a></p>
            </div>
            <div class="ps-5 col-lg-5">
                <div class="header_irght_content d-flex justify-content-between">
                    <ul class="icon_ul">
                        @foreach (App\Models\FooterIcon::all() as $icon)
                        <li><a href="{{$icon->icon_link}}"><i class="{{$icon->icon}}"></i></a></li>
                        @endforeach
                    </ul>
                    <div class="header_btn">
                        {{-- <a href="#" class="btn btn"><i class="fa-solid fa-briefcase"></i> Free Consulting</a> --}}
                       
                        @auth('customerlogin')
                        <div class="dropdown">
                            <a style="cursor: pointer;" class="login_regis" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{Auth::guard('customerlogin')->user()->name}}
                            </a>
                            <ul class="dropdown-menu logout_ul" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{route('customer.profile')}}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{route('customer.logout')}}">Logout</a></li>
                            </ul>
                        </div>
                        @else
                        <p class="login"><a href="{{route('customer.login')}}">Login</a></p>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- ================================
        Navbar Part Start
===================================-->
<nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="{{route('index')}}">
        @foreach (App\Models\Logo::where('status', 1)->get() as $logo)
            <img src="{{asset('upload/logo')}}/{{$logo->logo}}" width="180"  class="d-block img-fluid" alt="logo">
        @endforeach
      </a>
      
      <!-- ========Toggle Nave Button ==========-->
      <button class="btn btn-primary hidden-bar" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas-nav" aria-controls="offcanvasRight"><a href="#"><i class="fa-solid fa-bars"></i></a></button>
       
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas-nav" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            {{-- <a class="navbar-brand" href="{{route('index')}}">
                @foreach (App\Models\Logo::where('status', 1)->get() as $logo)
                    <img src="{{asset('upload/logo')}}/{{$logo->logo}}" width="180"  class="d-block img-fluid" alt="logo">
                @endforeach
              </a> --}}
              <div class="header_btn d-block d-lg-none" style="margin-left: 20px">
                    
                   
                <div class="dropdown">
                   
                     @auth('customerlogin')
                    <div class="dropdown">
                        <a style="cursor: pointer; color: #00194B; display: block; font-size: 18px; font-weight: 500;
                        position: relative; text-transform: capitalize;" class="login_regis" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{Auth::guard('customerlogin')->user()->name}}
                        </a>
                        <ul class="dropdown-menu logout_ul" style="margin-top: 0px" aria-labelledby="dropdownMenuButton1">
                            <li style="padding: 3px 10px"><a class="dropdown-item" href="{{route('customer.profile')}}">Profile</a></li>
                            <li style="padding: 3px 10px"><a class="dropdown-item" href="{{route('customer.logout')}}">Logout</a></li>
                        </ul>
                    </div>
                    @else
                    <p class="login"><a style="cursor: pointer; color: #00194B; display: block; font-size: 18px; font-weight: 500;
                        position: relative; text-transform: capitalize;" href="{{route('customer.login')}}">Login</a></p>
                    @endauth
                    </div>
                </div>
            <i class="fa-solid fa-xmark  sidebar-btn" data-bs-dismiss="offcanvas" aria-label="Close"></i>
        </div>
        <div class="nav-body">
            <form action="">
                <div class="mb-3">
                    <input type="text" class="form-control" name="" placeholder="Enter Keyword">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <div class="sidebar-nav">
                <h4>Menu</h4>
                <ul>
                    @foreach (App\Models\Menu::all(); as $menus)
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="{{route($menus->menu_link)}}">{{$menus->menu_name}}</a></li>
                    @endforeach
                </ul>
                <div class="header_btn d-block d-lg-none" style="margin-left: 20px">
                    {{-- <a href="#" class="btn btn"><i class="fa-solid fa-briefcase"></i> Free Consulting</a> --}}
                   
                    {{-- @auth('customerlogin')
                    <div class="dropdown">
                        <a style="cursor: pointer; color: #00194B; display: block; font-size: 18px; font-weight: 500;
                        position: relative; text-transform: capitalize;" class="login_regis" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{Auth::guard('customerlogin')->user()->name}}
                        </a>
                        <ul class="dropdown-menu logout_ul" style="margin-top: 0px" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="{{route('customer.logout')}}">Logout</a></li>
                        </ul>
                    </div>
                    @else
                    <p class="login"><a style="cursor: pointer; color: #00194B; display: block; font-size: 18px; font-weight: 500;
                        position: relative; text-transform: capitalize;" href="{{route('customer.login')}}">Login</a></p>
                    @endauth --}}
                </div>
            </div>
            <div class="nav_social_icon">
                <ul>
                    @foreach (App\Models\FooterIcon::all() as $icon)
                    <li><a href="{{$icon->icon_link}}"><i class="{{$icon->icon}}"></i></a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
            @foreach (App\Models\Menu::all(); as $menus)
            <li class="nav-item"><a class="nav-link" aria-current="page" href="{{route($menus->menu_link)}}">{{$menus->menu_name}}</a></li>
            @endforeach
          </ul>
        <div class="navbar_content">
                <div class="nav_icon">
                <i class="fa-solid fa-phone"></i>
                </div>
                <div class="content">
                    <span>Hot Line Number</span>
                    <a>{{$footer->phone}}</a>
                </div>
        </div>
        <div class="content_main d-flex">
      
            <!-- ========Toggle Top==========-->
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"> <a href="#"><i class="fas fa-search"></i></a></button>
       
               <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
               <div class="offcanvas-header">
                   <h5 class="offcanvas-title" id="offcanvasTopLabel"></h5>
                   <i class="fa-solid fa-xmark top-btn" data-bs-dismiss="offcanvas" aria-label="Close"></i>
               </div>
               <div class="search-wrap text-center">
                   <div class="container">
                       <div class="row">
                           <div class="col-lg-12">
                               <h2 class="search-title">Search</h2>
                               <div class="search-form">
                                   <div class="form">
                                       <input class="search_input" type="text" placeholder="Enter keyword">
                                       <button class="search-btn search_btn"><i class="fas fa-search"></i></button>
                                    </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
               </div>
            <!-- ========Toggle Right==========-->
            <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">   <a href="#"><i class="fa-solid fa-bars-staggered"></i></a></button>
       
               <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
               <div class="offcanvas-header">
                <div class="header_btn">
                    {{-- <a href="#" class="btn btn"><i class="fa-solid fa-briefcase"></i> Free Consulting</a> --}}
                   
                    @auth('customerlogin')
                    <div class="dropdown">
                        <a style="cursor: pointer; font-size:18px; color:#00194B; font-weight:700" class="login_regis" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{Auth::guard('customerlogin')->user()->name}}
                        </a>
                        <ul class="dropdown-menu logout_ul" aria-labelledby="dropdownMenuButton1">
                            <li style="padding: 3px 10px"><a class="dropdown-item" href="{{route('customer.profile')}}">Profile</a></li>
                            <li style="padding: 3px 10px"><a style="font-size: 18px;" class="dropdown-item" href="{{route('customer.logout')}}">Logout</a></li>
                        </ul>
                    </div>
                    @else
                    <p class="login"  ><a style="font-size: 18px; font-weight: 700; color:#00194B" href="{{route('customer.login')}}">Login</a></p>
                    @endauth 
                </div>
                   <h5 class="offcanvas-title" id="offcanvasRightLabel"></h5>
                   <i class="fa-solid fa-xmark  sidebar-btn" data-bs-dismiss="offcanvas" aria-label="Close"></i>
                   
               </div>
               <div class="offcanvas-body">
                
                   <div class="sidebar-logo">
                    @foreach (App\Models\Logo::where('status', 1)->get() as $logo)
                        <img src="{{asset('upload/logo')}}/{{$logo->logo}}" width="150"  class="d-block img-fluid" alt="logo">
                    @endforeach
                           <hr>
                   </div>
                       <div class="sidebar-contact-list">
                               <h4>Office Address</h4>
                               <p>{{$footer->address}}</p>
                       </div>
                       <div class="sidebar-contact-list">
                       <h4>Phone Number</h4>
                       <ul>
                           <li><a href="#">{{$footer->phone}}</a></li>
                       </ul>
                       </div>
                       <div class="sidebar-contact-list">
                           <h4>E-mail Address</h4>
                           <ul>
                               <li><a href="#">{{$footer->email}}</a></li>
                           </ul>
                       </div>
                       <div class="sidebar-gallery-img">
                           <ul >
                            @foreach (App\Models\Gallery::paginate(3); as $gal)
                               <li class="gallery" ><a href="{{route('gallery')}}"><img src="{{asset('upload/gallery')}}/{{$gal->gallery_image}}" width="100" alt="sidebar-img-01"></a></li>
                               @endforeach
                           </ul>
                       </div>
                       <div class="sidebar_bottom_btn">
                           <ul class="social-icon">
                            @foreach (App\Models\FooterIcon::all() as $icon)
                            <li><a href="{{$icon->icon_link}}"><i class="{{$icon->icon}}"></i></a></li>
                            @endforeach
                           </ul>
                       </div>
               </div>
               </div>
             </div>
      </div>
   </div>
</nav>


@yield('content')

<!-- ======================================
        Request Call Back Part
========================================-->

<section id="request_call">
    <div class="animation_img">
        <img  src="images/request_call_ani-1.png" class="img-fluid animation_one" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 m-auto">
                
                <div class="request_content m-auto">
                    @foreach (App\Models\Request_form::where('id', 1 )->get() as $title )
                  
                        <h2>{{$title->title}}</h2>
                        <p>{{$title->desp}}</p>
                  
                    @endforeach
                   
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <form action="{{route('message.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <input type="text" name="user_name" placeholder="Name*" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <input type="email" name="user_email" placeholder="E-mail*" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <input type="number" name="user_phone" placeholder="Phone*" class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <textarea name="user_desp" class="form-control" style="resize: none; height: 100px;" placeholder="Content*" cols="30" rows="10"></textarea>
                                </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-4">
                               <button type="submit" class="btn w-100">Send Message</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- ==============================
    Footer Section Part 
====================================-->
<section id="footer_part">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-7">
                <div class="footer-widget mb-3">
                   
                   <div class="footer_logo">
                        <a  href="{{route('index')}}"><img width="150" src="{{asset('upload/footer')}}/{{$footer->footer_logo}}" alt="logo"></a>
                   </div>
                   <div class="footer_info">
                        <p>DotOptimize, an IT firm, focuses on Software Development, Digital Marketing, Graphic Design, and SEO, providing innovative solutions to boost growth and efficiency.</p>
                        <ul>
                            <li>
                                <div class="footar-details-cion">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="footer-text">
                                    {{$footer->address}}
                                </div>
                            </li>
                           
                            <li>
                                <div class="footar-details-cion">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="footer-text">
                                    <a href="tel:+88 01711-734197" dir="ltr">{{$footer->phone}}</a>
                                </div>
                            </li>
                            <li>
                                <div class="footar-details-cion">
                                    <i class="fa-regular fa-clock"></i>
                                </div>
                                <div class="footer-text">
                                    {{$footer->close_day}}
                                </div>
                            </li>
                        </ul>
                   </div>
                </div>
            </div>
            <div class="col-lg-2 col-6 col-sm-6 col-md-5">
                <div class="footer-widget mb-3">
                    <h4 class="footer_title">Menu</h4>
                    <div class="footer-link">
                        <ul class="list-wrap">
                            <li><a href="{{route('company')}}"> Company </a></li>
                            <li><a href="{{route('career')}}"> Careers </a></li>
                            <li><a href="{{route('gallery')}}"> Press Media </a></li>
                            <li><a href="{{route('blog')}}"> Our Blog </a></li>
                            <li><a href="{{route('policy')}}"> Privacy Policy </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-6 col-sm-6 col-md-5">
                <div class="footer-widget fuck mb-3">
                    <h4 class="footer_title">Quick Links</h4>
                    <div class="footer-link">
                        <ul class="list-wrap">
                            <li><a href="{{route('how.work')}}">How it work</a></li>
                            <li><a href="{{route('testimonial')}}">Testimonial</a></li>
                            <li><a href="{{route('case.studiy')}}"> Case Studies</a></li>
                            <li><a href="{{route('provide.info')}}"> Provide Your Information</a></li>
                            <li><a href="{{route('plan')}}">Pricing</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-7">
                <div class="footer-widget fuck mb-3">
                    <h4 class="footer_title">Our Newsletters</h4>
                    <p class="newsletter">Add A Newsletter To Your Widget Area.</p>
                    <form action="{{route('subscribe')}}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input type="email" class="form-control" placeholder="Enter Your E-mail" name="sub_email">
                            <button type="submit" class="btn">Subscribe</button>
                        </div>
                    </form>
                    <div class="footer_social_icon">
                        <ul>
                            @foreach (App\Models\FooterIcon::all() as $icon)
                                <li><a href="{{$icon->icon_link}}"><i class="{{$icon->icon}}"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-text text-center">
                        @php
                            $footer_end =  App\Models\FooterCopyright::all();
                            foreach ($footer_end as $copy) {
                            $footers = $footer;
                        }
                        @endphp
                        <p>{{$copy->title}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

  <!-- =============== back to top =========== -->
  <div class="back_to_top">
    <i class="fa-solid fa-arrow-up "></i>
</div>



    
    <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('frontend/js/slick.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('frontend/js/noframework.waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/js/progressBar.min.js')}}"></script>
    <script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/js/counterup.min.js')}}"></script>
    <script src="{{asset('frontend/js/wow.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{asset('frontend/js/script.js')}}"></script>

    {{-- <script>
        $('#search_btn').click(function(){
            var search_input = $('#search_input').val();
            var link = '{{route('search')}}' + ' ?q=' +search_input ;
            window.location.href = link;
            
        
        });
    </script> --}}

    @yield('footer_script')

    <script>
        // request call
                @if(Session::has('messagesuccess'))
                toastr.options =
                {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                }
                        toastr.success("{!! session('messagesuccess') !!}");
                @endif

                @if(Session::has('message_error'))
                toastr.options =
                {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                }
                        toastr.error("{!! session('message_error') !!}");
                @endif

        // subscription email
                @if(Session::has('sub_email'))
                toastr.options =
                {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                }
                        toastr.error("{!! session('sub_email') !!}");
                @endif


                @if(Session::has('sub_success'))
                    toastr.options =
                    {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right",
                    }
                            toastr.success("{!! session('sub_success') !!}");
                @endif

    </script>

<script>
    $('.search_btn').click(function(){
        var search_input = $('.search_input').val();
        var link = "{{ route('search') }}" + "?q=" + search_input;
        window.location.href = link;
    });
</script>

</body>
</html>