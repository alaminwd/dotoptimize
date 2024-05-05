@extends('layouts.dashboard')

@section('content')
    @can('order_information')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-info d-block">
                        <h3 class="text-white " style="text-align: center;">Order Information</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-responsive">
                            <tr class="text-center">
                                <th>Name</th>
                                <th>Email</th>
                                <th>Number</th>
                                <th>Plan</th>
                                <th>Payment Method</th>
                                <th>paymentID</th>
                                <th>Status</th>
                                <th>Status Update</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                               @foreach ($orders as $sl=>$order)
                                   <tr class="text-center">
                                        <td>{{$order->name}}</td>
                                        <td>{{$order->email}}</td>
                                        <td>{{$order->phone}}</td>
                                        <td>{{$order->plan_name}}</td>
                                        <td>
                                            @if ($order->payment_method == 1)
                                                    <div class="badge badge-primary"> {{'AamarPay'}}</div>
                                                @elseif ($order->payment_method == 2)

                                                <div class="badge badge-primary">  {{'Bkash'}}</div>

                                                @else
                                                <div class="badge badge-primary">  {{'Stripe'}}</div>

                                            @endif
                                        </td>
                                        <td>{{$order->paymentID}}</td>
                                        <td>
                                           @php
                                                if ($order->status == 0) {
                                                    echo ' <span class="badge badge-primary">Placed</span>';
                                                }
                                                elseif ($order->status == 1) {
                                                    echo ' <span class="badge badge-primary">Processing</span>';
                                                }
                                                else {
                                                    echo ' <span class="badge badge-primary">completed</span>';
                                                }
                                                 
                                
                                           @endphp
                                        </td>
                                        <td>
                                            <div class="dropdown mb-3">
                                               <form action="{{route('status.update')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                                <a href="javascript:void(0)" class="more-button" data-toggle="dropdown" aria-expanded="false">
                                                    <svg width="6" height="26" viewBox="0 0 6 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6 3C6 4.65685 4.65685 6 3 6C1.34315 6 0 4.65685 0 3C0 1.34315 1.34315 0 3 0C4.65685 0 6 1.34315 6 3Z" fill="#585858"></path>
                                                        <path d="M6 13C6 14.6569 4.65685 16 3 16C1.34315 16 0 14.6569 0 13C0 11.3431 1.34315 10 3 10C4.65685 10 6 11.3431 6 13Z" fill="#585858"></path>
                                                        <path d="M6 23C6 24.6569 4.65685 26 3 26C1.34315 26 0 24.6569 0 23C0 21.3431 1.34315 20 3 20C4.65685 20 6 21.3431 6 23Z" fill="#585858"></path>
                                                    </svg>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <button class="dropdown-item" name="status" value="0" >Placed</button>
                                                    <button class="dropdown-item" name="status" value="1" >Processing</button>
                                                    <button class="dropdown-item" name="status" value="2" >completed</button>
                                                </div>
                                               </form>
                                            </div>
                                        </td>
                                        <td>
                                        <a href="{{route('order.delete', $order->id)}}" class="btn btn-danger">Delete</a>
                                        </td>
                                   </tr>
                               @endforeach
                                
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
    @endcan
@endsection