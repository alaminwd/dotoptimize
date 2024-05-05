@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Applicants Details</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                       <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Download Cv</th>
                        <th>Action</th>
                       </tr>
                       @foreach ($applicants as $sl=> $applicant)
                           <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$applicant->name}}</td>
                                <td>{{$applicant->email}}</td>
                                <td>{{$applicant->phone}}</td>
                                <td>
                                    <a href="{{route('download.cv', $applicant->id)}}" class="badge badge-primary">Download Cv</a>
                                </td>
                                <td><a class="btn btn-danger" href="{{route('applicant.delete', $applicant->id)}}">Delete</a></td>
                           </tr>
                       @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection