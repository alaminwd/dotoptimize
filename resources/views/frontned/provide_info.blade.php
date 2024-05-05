@extends('frontned.master')

@section('content')
    <section id="provide_info" style="padding: 50px 0px">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 m-auto">
                    <div class="card" style="border: none; box-shadow: rgba(136, 165, 191, 0.48) 6px 2px 16px 0px, rgba(255, 255, 255, 0.8) -6px -2px 16px 0px;" >
                        <div class="card-header" style="padding: 25px 0; text-align:center; background:#fff">
                            <h5>Provide Your Information</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{route('store.info')}}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label>Full Name</label>
                                    <input type="text" name="name" class="form-control">
                                    @error('name')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Phone Number</label>
                                    <input type="number" name="phone" class="form-control">
                                    @error('phone')
                                         <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Full Address</label>
                                    <input type="text" name="address" class="form-control">
                                    @error('address')
                                      <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Facebook Link</label>
                                    <input type="text" name="fblink" class="form-control">
                                    @error('fblink')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-dark w-100" style="font-size: 16px; font-weight:600">Send Info</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection