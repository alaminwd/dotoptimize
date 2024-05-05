@extends('layouts.dashboard')

@section('content')
    <div class="row mt-4">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Message View</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{$message_info->user_name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$message_info->user_email}}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{$message_info->user_phone}}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{{$message_info->user_desp}}</td>
                        </tr>
                    </table>
                    <div class="mb-4">
                        <a href="mailto:{{$message_info->user_email}}" class="btn btn-info">Message Reply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection