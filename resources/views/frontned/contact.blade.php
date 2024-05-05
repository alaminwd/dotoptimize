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
                    <h2>Contact</h2>
                </div>
            </div>
        </div>
    </div>
</section>


<!--=================================
    Contact Paart 
===================================-->
<section id="contact-section">
    <div class="contact-shape">
        <img src="{{asset('frontend/images/contact-shape.png')}}" width="50" alt="shape">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-5 m-auto">
                <div class="contact-content">
                    <div class="contact-title">
                            
                        <span>{{$content_info->sub_title}}</span>
                        <h2>{{$content_info->title}}</h2>
                    </div>
                    <p>{{$content_info->desp}}</p>
                </div>
            </div>
            <div class="col-lg-7">
                <form action="{{route('contact.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="text" class="form-control" placeholder="Name*" name="name">
                               
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="Email" class="form-control" placeholder="Email*" name="email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="number" class="form-control" placeholder="Phone*" name="number">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="text" class="form-control" placeholder="Subject*" name="subject">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mt-3">
                                <textarea name="desp" class="form-control" style="resize: none; height: 100px;" placeholder="Content*" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
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

<!-- ===============================
        inner contact area
===============================-->

<section id="inner_contact_area">
    <div class="container">
        @foreach ($address_info as $info)
        <div class="row mt-5">
            <div class="col-lg-4 col-md-6 m-auto">
                <div class="inner_contact_img">
                    <img src="{{asset('upload/office_address')}}/{{$info->image}}" class=" img-fluid" alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6 m-auto">
                <div class="inner_contact_details">
                    <h2>{{$info->title}}</h2>
                <div class="contact-info-item">
                    <h5>{{$info->sub_title}}</h5>
                    <ul>
                        <li>{{$info->location}}</li>
                        <li>{{$info->phone}}</li>
                        <li>{{$info->email}}</li>
                    </ul>
                    </div>
                 </div>
            </div>
        </div>
        @endforeach
    </div>
</section>


<!-- ==============================
        Google Maps 
=================================-->

<section id="google-map">
    <div class="container-fluid">
      <div class="row">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14608.039158733363!2d90.36554080278788!3d23.747030307337045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b33cffc3fb%3A0x4a826f475fd312af!2sDhanmondi%2C%20Dhaka%201205!5e0!3m2!1sen!2sbd!4v1701326155158!5m2!1sen!2sbd"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </section>
  

@endsection

@section('footer_script')
<script>
    @if(Session::has('success'))
           toastr.options =
           {
               "closeButton": true,
               "progressBar": true,
               "positionClass": "toast-bottom-right",
           }
                   toastr.success("{!! session('success') !!}");
           @endif
    @if(Session::has('contact_error'))
           toastr.options =
           {
               "closeButton": true,
               "progressBar": true,
               "positionClass": "toast-bottom-right",
           }
                   toastr.error("{!! session('contact_error') !!}");
           @endif
</script>
@endsection