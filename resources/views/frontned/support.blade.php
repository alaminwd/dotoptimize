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
                                 <li><a href="{{route('order.history')}}">My Order</a></li>
                                 <li><a href="{{route('customer.profile')}}">Profile Info</a></li>
                                 <li><a href="{{route('pay')}}">Pay</a></li>
                                 <li><a href="{{route('customer.logout')}}">Logout</a></li>
                                </ul>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card update_cart">
                    <div class="card-body">
                        <form action="{{route('support.request')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label >Title*</label>
                                        <input type="text" class="form-control" name="title">
                                        @php
                                            
                                        @endphp
                                        <input type="hidden" class="form-control" name="customer_id" value="{{Auth::guard('customerlogin')->id()}}">
                                        @error('title')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label >Description*</label>
                                        <textarea name="desp" class="form-control" style="resize: none; height: 100px;" placeholder="Content*" cols="30" rows="10"></textarea>
                                        @error('desp')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label >Profile Image*</label>
                                        <input type="file" class="form-control" name="file">
                                        @error('file')
                                            <div class="alert alert-danger">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-4">
                                        <button type="submit" class="btn btn-dark">Update Profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection