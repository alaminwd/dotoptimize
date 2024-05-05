@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>Welcome to Dashboard</h4></div>

                <div class="card-body">
                    <h2>You are logged In, <strong class="text-danger">{{Auth::user()->name}}</strong></h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
