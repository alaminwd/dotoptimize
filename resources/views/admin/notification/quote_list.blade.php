@extends('layouts.dashboard')

@section('content')
    @can('quotation')
        
    
    <div class="row mt-4">
        <div class="col-lg-10 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Quotaion List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($quotes as $quote)
                            <tr class="bg-{{$quote->status==0?'light':''}}">
                                <td>{{$quote->name}}</td>
                                <td>{{$quote->email}}</td>
                                <td>{{substr($quote->desp, 0, 15)}}..</td>
                                <td>
                                    <a href="{{route('Quote.view', $quote->id)}}" class="btn btn-success">View</a>
                                    <a href="{{route('Quote.delete', $quote->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>{{$quotes->links()}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
    <h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
    @endcan
@endsection