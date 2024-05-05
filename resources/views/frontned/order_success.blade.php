@extends('frontned.master');

@section('content')
<style>
    section.middle {
        padding: 50px 0 50px;
    }
    section.middle .one{
        border-radius: 50%;
        height: 70px;
        width: 70px;
    }
    section.middle p{
        font-size: 16px;
        font-weight: 600;
        line-height: 24px;
        margin-top: 20px ;
    }
</style>

<section class="middle">

    <div class="container">
    
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8 col-xl-6 text-center">

                <!-- Icon -->
                <div class="one p-2 d-inline-flex align-items-center justify-content-center circle text-success mx-auto mb-4" style="background-color: #e8fdeb;">
                    <i style="font-size: 25px;" class="fas fa-heart"></i>
                </div>
                <!-- Heading -->
                <h2 class="mb-2" style="font-size: 30px; font-weight:600; line-height:35px"> Your Payment Successfully added !</h2>
                <p class="ft-regular fs-md mb-5">Check your email And All Information sent you email  .</p>
            </div>
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
    </script>
@endsection