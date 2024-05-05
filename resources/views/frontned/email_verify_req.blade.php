@extends('frontned.master')

@section('content')
<section id="simple-form">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-6 m-auto">
                <div class="user_form">
                    <div class="card-header">
                        <h4>Email Verify Request</h4>
                    </div>
                    @if (session('email_requst'))
                        <p class="alert alert-danger">{{session('email_requst')}}</p>
                    @endif
                    @if (session('verify'))
                        <p class="alert alert-success">{{session('verify')}}</p>
                    @endif
                   <div class="card-body">
                        <form action="{{route('email.verify.requ.send')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email *</label>
                                <input type="email" name="email" class="form-control">
                                @error('email')
                                    <p class="alert alert-danger">{{$message}}</p>
                                     
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">SEND</button>
                            </div>                
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection