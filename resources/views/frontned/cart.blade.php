@extends('frontned.master')


@section('content')
<section id="simple-form">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-8 m-auto">
                <div class="user_form">
                    <div class="card-header">
                        <h3>Purchase Plan </h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('chekout')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name *</label>
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
                                        <label class="form-label"> Plan Name *</label>
                                        <input type="text" readonly class="form-control" name="plan_name" value="{{$plan_info->plan_name}}">
                                        @error('plan_name')
                                            <strong class="text-danger">{{$message}}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Price *</label>
                                        <input type="number" readonly name="price" class="form-control" value="{{$plan_info->price}}">
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
            </div>
        </div>
    </div>
</section>

@endsection

@section('footer_script')

   <script>
         $(document).ready(function() {
        $('.country_id').select2();
        $('.city_id').select2();
            });

   </script>

   <script>


         $('.country_id').change(function(){
        var country_id = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type:'POST',
            url:'/getCities',
            data:{'country_id': country_id},
            success:function(data){
                $('.city_id').html(data);
           }
        });
        
    });
   </script>
@endsection
