@extends('frontned.master')


@section('content')
      <!-- ===========================================
              Login Form  Part 
  ================================================-->
  <section id="simple-form">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6 m-auto">
                <div class="user_form">
                   <div class="card-header">
                        <h3>Login Form</h3>
                   </div>
                   @if (session('login'))
                       <div class="alert alert-danger">{{session('login')}}</div>
                   @endif
                   @if (session('error'))
                       <div class="alert alert-danger">{{session('error')}}</div>
                   @endif
                   @if (session('verify_success'))
                       <div class="alert alert-success">{{(session('verify_success'))}}</div>
                   @endif
                   @if (session('no_verify'))
                    <div class="alert alert-success">{{(session('no_verify'))}}
                        <a href="{{route('again.verify.request')}}" class="btn btn-success" style="color: white">Send Verify Request</a>
                    </div>
                   @endif
                    @if (session('wrong'))
                    <div class="alert alert-danger">
                        <strong class="text-danger">{{(session('wrong'))}}</strong>
                    </div>
                   @endif
                   <div class="card-body">
                        <form action="{{route('customer.login.info')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control">
                                @error('email')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password *</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Sign In</button>
                            </div>
                            <div class="mt-5">
                                <p><a style="margin-bottom: 15px; color:#000; font-size:16px" href="{{route('check.email')}}">Forgot Password !</a></p>
                              <p>Not a Member ? <a href="{{route('customer.register')}}">Singup</a></p>
                          </div>
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</section>



@endsection