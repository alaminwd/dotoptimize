@extends('frontned.master')

@section('content')
<section id="profile_info">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4" >
                <div class="customer_profile">
                    <div class="card">
                        <div class="card-header">
                          
                            @if (Auth::guard('customerlogin')->user()->photo == null)
                            <img width="120"  height="120" style="border-radius: 50%" src="{{ Avatar::create(Auth::guard('customerlogin')->user()->name)->toBase64()}}"/>
                            @else
                            <img width="120" height="120" style="border-radius: 50%" src="{{asset('upload/customer')}}/{{Auth::guard('customerlogin')->user()->photo}}" alt="">
                        @endif
                            <h4 class="customer_name">{{Auth::guard('customerlogin')->user()->name}}</h4>
                            {{-- <h5 class="customer_address">Australia</h5> --}}
                        </div>
                        <div class="card-body">
                            <div class="dashboard_author">
                                <h4>DASHBOARD NAVIGATION</h4>
                            </div>
                            <div class="mt-4">
                                <ul>
                                 
                                 <li><a href="{{route('customer.profile')}}">Profile Info</a></li>
                                 <li><a href="{{route('support')}}">Support</a></li>
                                 <li><a href="{{route('pay')}}">Pay</a></li>
                                 <li><a href="{{route('customer.logout')}}">Logout</a></li>
                                </ul>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card update_cart">
                    <div class="card-header text-center p-4" style="background: #f4f5f7; border-bottom:0px">
                        <h4 class="">Order History</h4>
                    </div>
                    <div class="card-body">
                       <div class="row">
                           @foreach ($orders as $order)
                           <div class="col-lg-8">
                            <div class="na" style="margin-top:30px">
                                <h6>Service :{{$order->plan_name}}</h6>
                            </div>
                            <div class="amount" style="margin:8px 0">
                                <h6 style="font-weight: 700; font-size:15px">Amount : &#2547;{{$order->price}}</h6>
                            </div>
                        </div>
                        <div class="col-lg-4">
                           <div class="right-content" style="text-align: center; margin-top:30px" >
                                <h6 style="margin-bottom:10px; ">Status</h6>
                                <p style="font-size: 12px; font-weight:500; padding:5px 8px; background: #0B2A97; display:inline; border-radius:30px; color:#fff" >
                                    
                                    @php                
                                        if ($order->status == 0) {
                                           echo "Placed";
                                        }
                                        elseif ($order->status == 1) {
                                            echo "Precessing";
                                        }
                                        elseif ($order->status == 2) {
                                            echo "Completed";
                                        }
                                        
                                    @endphp

                                </p>
                           </div>
                        </div>
                           @endforeach
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection