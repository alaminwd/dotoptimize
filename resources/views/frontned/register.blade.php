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
                      <h3>Registation Form</h3>
                 </div>
                 <div class="card-body">
                    @if (session('verify'))
                        <div class="alert alert-success">{{(session('verify'))}}</div>
                    @endif
                      <form action="{{route('customer.store')}}" method="POST">
                        @csrf
                          <div class="mb-3">
                              <label class="form-label">Name *</label>
                              <input type="text" name="name" class="form-control"  >
                              @error('name')
                                  <div class="alert alert-danger">{{$message}}</div>
                              @enderror
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Email *</label>
                              <input type="email" name="email" class="form-control">
                              @error('email')
                                <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                          </div>
                          <div class="mb-3">
                              <label  class="form-label">Phone Number *</label>
                              <input type="number" name="phone" class="form-control">
                                @error('phone')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                          </div>
                          <div class="mb-3">
                              <label class="form-label">Password *</label>
                              <input type="password" name="password" class="form-control" >
                                @error('password')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                          </div>
                          <div class="mb-3">
                              <button type="submit" class="btn btn-primary">SingUp</button>
                          </div>
                          <div class="mt-5">
                              <p>Already have an account ? <a href="{{route('customer.login')}}">Sing In</a></p>
                          </div>
                      </form>
                 </div>
              </div>
          </div>
        </div>
    </div>
</section>



@endsection