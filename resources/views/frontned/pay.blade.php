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
                                 <li><a href="{{route('order.history')}}">My Order</a></li>
                                 <li><a href="{{route('customer.logout')}}">Logout</a></li>
                                </ul>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-xl-8">
                <section id="simple-form" style="background:transparent">    
                    <div class="user_form" style="background: transparent;">
                        <div class="card-header">
                            <h3>Purchase </h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('payment.store')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Name*</label>
                                            <input type="text" name="name" class="form-control" readonly value="{{Auth::guard('customerlogin')->user()->name}}">
                                            <input type="hidden" name="customer_id" value="{{Auth::guard('customerlogin')->user()->id}}">
                                            @error('name')
                                                <strong class="text-danger">{{$message}}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email *</label>
                                            <input type="email" name="email" class="form-control" readonly value="{{Auth::guard('customerlogin')->user()->email}}">
                                            @error('email')
                                                <strong class="text-danger">{{$message}}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        
                                        <div class="mb-3">
                                            <label class="form-label">Phone Number *</label>
                                            <input type="number" name="phone_number" class="form-control" readonly value="{{Auth::guard('customerlogin')->user()->phone}}">
                                            @error('phone_number')
                                                <strong class="text-danger">{{$message}}</strong>
                                            @enderror
                                        </div>
                                    </div>        
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label"> Title *</label>
                                            <input type="text"  class="form-control" name="plan_name">
                                            @error('plan_name')
                                                <strong class="text-danger"></strong>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label">Price *</label>
                                            <input type="number"  name="price" class="form-control">
                                            @error('price')
                                                <strong class="text-danger">{{$message}}</strong>
                                            @enderror
                                        </div>
                                    </div>
                                        <div class="three d-flex justify-content-center  justify-content-between flex-wrap ">
                                            @foreach ($banks as $bank)
                                            <div class="col-lg-4 m-auto payment">
                                                <div class="mb3 pay_op " >
                                                    <input type="radio" id="option{{$bank->id}}" name="payment_method" value="{{$bank->id}}" style="cursor: pointer">
                                                    <label style="cursor: pointer" for="option{{$bank->id}}"><img src="{{asset('upload/bank')}}/{{$bank->bank_logo}}" alt=""></label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @error('payment_method')
                                            <div class="mb-3">
                                                <strong class="text-danger mb-3">{{$message}}</strong>
                                            </div>
                                        @enderror
                                    <div class="col-lg-6 m-auto mt-3">
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary">Purchase Now</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</section>
@endsection