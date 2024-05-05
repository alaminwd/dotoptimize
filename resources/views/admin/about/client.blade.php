@extends('layouts.dashboard')

@section('content')
    @can('our_client')
    <div class="row mt-5">
        <div class="col-lg-8">
           <div class="card">
            <div class="card-header">
                <h3>Client List</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>Comany Name</th>
                        <th>Comany Link</th>
                        <th>Comany logo</th>
                        <th>Action</th>
                    </tr>
    
                    @foreach ($clients as $sl=>$client)
                        <tr>
                            <td>{{$client->company_name}}</td>
                            <td>{{$client->company_link}}</td>
                            <td>
                                <img width="70" src="{{asset('upload/client')}}/{{$client->company_logo}}" alt="">
                            </td>
                            <td>
                                <div class="dropdown mb-3">
                                    <a href="javascript:void(0)" class="more-button" data-toggle="dropdown" aria-expanded="false">
                                        <svg width="6" height="26" viewBox="0 0 6 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6 3C6 4.65685 4.65685 6 3 6C1.34315 6 0 4.65685 0 3C0 1.34315 1.34315 0 3 0C4.65685 0 6 1.34315 6 3Z" fill="#585858"></path>
                                            <path d="M6 13C6 14.6569 4.65685 16 3 16C1.34315 16 0 14.6569 0 13C0 11.3431 1.34315 10 3 10C4.65685 10 6 11.3431 6 13Z" fill="#585858"></path>
                                            <path d="M6 23C6 24.6569 4.65685 26 3 26C1.34315 26 0 24.6569 0 23C0 21.3431 1.34315 20 3 20C4.65685 20 6 21.3431 6 23Z" fill="#585858"></path>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="{{route('client.delete', $client->id)}}" class="dropdown-item">Delete</a>
                                    </div>
                                </div>
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
                    <h3>Add Company Logo</h3>
                </div>
                @if (session('client_logo'))
                <div class="alert alert-success">{{session('client_logo')}}</div>
                @endif
                
                <div class="card-body">
                    <form action="{{route('client.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label>Comapny Name</label>
                            <input type="text" name="company_name" class="form-control">
                            @error('company_name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Comapny link</label>
                            <input type="text" name="company_link" class="form-control">
                            @error('company_link')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Comapny Logo</label>
                            <input type="file" name="company_logo" class="form-control">
                            @error('company_logo')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            @if (session('photo_error'))
                                <strong class="text-danger">{{session('photo_error')}}</strong>
                            @endif
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Add logo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
    @endcan
@endsection