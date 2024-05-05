@extends('layouts.dashboard')

@section('content')
    @can('api_configuration')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3>All logos List</h3>
                    </div>
                    @if (session('logodel'))
                        <div class="alert alert-success">{{session('logodel')}}</div>
                    @endif
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Bank Name</th>
                                <th>Bank Logo</th>
                                <th>Action</th>
                            </tr>
    
                            @foreach ($banks as $sl=>$bank)
                                <tr>
                                    <td>{{$sl+1}}</td>
                                    <td>{{$bank->bank_name}}</td>
                                    <td><img width="60" src="{{asset('upload/bank')}}/{{$bank->bank_logo}}" alt=""></td>
                                    <td>
                                        <a href="{{route('bank.delete', $bank->id)}}" class="btn btn-danger">Delete</a>
                                        <a href="{{route('bank.status', $bank->id)}}" class="btn btn-{{$bank->status == 1?'success':'light'}}">{{$bank->status == 1?'On':'Off'}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Banking</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{route('bank.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label>Banking  Name</label>
                                <input type="text" name="bank_name" class="form-control">
                                @error('bank_name')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Banking Logo</label>
                                <input type="file" name="bank_logo" class="form-control">
                                @error('bank_logo')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                                @if (session('photo_error'))
                                    <strong class="text-danger">{{session('photo_error')}}</strong>
                                @endif
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-success" type="submit">Add Backing</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-5">
               <div class="card">
                    <div class="card-header">
                        <h3>Add Bkash Appi Key</h3>
                    </div>
                    <div class="card-body">
                        @foreach ( $bkash_api as $bkash )
                        <form action="{{route('update.bkash.api')}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label>Bkash User Name</label>
                                <input type="text" class="form-control" name="user_name" value="{{$bkash->bkash_username}}">

                                <input type="hidden" name="id" value="{{$bkash->id}}">
                                @error('user_name')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Bkash Password</label>
                                <input type="text" class="form-control" name="bkash_password" value="{{$bkash->bkash_password}}">
                                @error('bkash_password')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Bkash App Key</label>
                                <input type="text" class="form-control" name="bkash_app_key"  value="{{$bkash->bkash_app_key}}">
                                @error('bkash_app_key')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label>Bkash App Secret</label>
                                <input type="text" class="form-control" name="bkash_app_secret" value="{{$bkash->bkash_app_secret}}">
                                @error('bkash_app_secret')
                                 <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-info">Add Api</button>
                            </div>
                        </form>
                        @endforeach
                    </div>
               </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                     <div class="card-header">
                         <h3>Add AamarPay Appi</h3>
                     </div>
                     <div class="card-body">
                         @foreach ( $aamarpay_api as $aamarpay )
                         <form action="{{route('update.aamarpay.api')}}" method="POST">
                             @csrf
                             <div class="mb-3">
                                 <label>store_id</label>
                                 <input type="text" class="form-control" name="store_id" value="{{$aamarpay->store_id}}">
                                 <input type="hidden" name="id" value="{{$aamarpay->id}}">
                                 @error('store_id')
                                     <div class="alert alert-danger">{{$message}}</div>
                                 @enderror
                             </div>
                             <div class="mb-3">
                                 <label>signature key</label>
                                 <input type="text" class="form-control" name="signature_key" value="{{$aamarpay->signature_key}}">
                                 @error('signature_key')
                                     <div class="alert alert-danger">{{$message}}</div>
                                 @enderror
                             </div>
                             <div class="mb-3">
                                 <button type="submit" class="btn btn-info">Update AamayPay</button>
                             </div>
                         </form>
                         @endforeach
                     </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="text-white">Stripe payment Gateway</h3>
                    </div>
                    <div class="card-body">
                        @foreach ($stripe_api as $api)
                        <form action="{{route('update.stripe')}}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">STRIPE_KEY</label>
                                <input type="text" name="stripe_key" class="form-control" value="{{$api->stripe_key}}">
                                <input type="hidden" name="id" value="{{$api->id}}">
                                @error('stripe_key')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">STRIPE_SECRET</label>
                                <input type="text" name="stripe_secret" class="form-control" value="{{$api->stripe_secret}}">
                                @error('stripe_secret')
                                    <div class="alert alert-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-info">Save Api</button>
                            </div>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
    @endcan
       
@endsection