@extends('layouts.dashboard')

@section('content')
    <div class="row mt-4">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Quotation View</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{$quotes_info->name}}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{$quotes_info->email}}</td>
                        </tr>
                        <tr>
                            <th>Message</th>
                            <td>{{$quotes_info->desp}}</td>
                        </tr>
                    </table>
                    <div class="mb-4">
                        <a href="mailto:{{$quotes_info->email}}" class="btn btn-info">Message Reply</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection