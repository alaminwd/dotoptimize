@extends('frontned.master')

@section('content')
<section id="simple-form">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6 m-auto">
                <div class="user_form">
                    <div class="card-header">
                        <h4>Password Reset </h4>
                    </div>
                    @if (session('reset_success'))
                        <p class="alert alert-success">{{session('reset_success')}}</p>
                    @endif
                   <div class="card-body">
                        <form action="{{route('password.reset.confirm')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">New Password *</label>
                                <input type="password" name="password" class="form-control">
                                <input type="hidden" name="token" value="{{$token}}">
                                @error('password')
                                    <p class="alert alert-danger">{{$message}}</p>
                                     
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirm Password *</label>
                                <input type="password" name="password_confirmation" confirm class="form-control">
                                
                                @error('password_confirmation')
                                    <p class="alert alert-danger">{{$message}}</p>
                                     
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">Reset Password</button>
                            </div>                
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection