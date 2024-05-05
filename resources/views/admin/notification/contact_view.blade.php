@extends('layouts.dashboard')

@section('content')
    <div class="row mt-4">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Contact Message View</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{$message_info->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$message_info->email}}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{$message_info->number}}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{$message_info->subject}}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{{$message_info->desp}}</td>
                        </tr>
                    </table>
                    <div class="mb-4">
                        <a href="mailto:{{$message_info->email}}" class="btn btn-info">Message Reply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection