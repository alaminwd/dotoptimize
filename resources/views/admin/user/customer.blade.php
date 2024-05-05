@extends('layouts.dashboard')



@section('content')
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white" style="width:100%">customer list <span class="float-right">Total:  {{$total_customer}}</span></h3>
            </div>
            <div class="card-body">
               <table class="table table-bordered">
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Photo</th>
                    <th>Action</th>
                </tr>

                @foreach ($customers as $sl=>$customer)
                <tr>
                    <td>{{$sl+1}}</td>
                    <td>{{$customer->name}}</td>
                    <td>{{$customer->email}}</td>
                    <td>{{$customer->phone}}</td>
                    <td>
                        @if ($customer->photo == null)
                            <img width="60" height="60" style="border-radius: 50%" src="{{ Avatar::create($customer->name)->toBase64()}}"/>
                            @else
                            <img width="60" height="60" style="border-radius: 50%" src="{{asset('upload/customer')}}/{{$customer->photo}}" alt="">
                        @endif
                    </td>
                    <td>
                        <button data-id="{{route('customer.delete', $customer->id)}}" class="d_btn btn btn-danger">Delete</button>
                    </td>
                </tr>
                @endforeach
               </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
<script>
    $('.d_btn').click(function(){
         Swal.fire({
             title: 'Are you sure?',
             text: "You won't be able to revert this!",
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, delete it!'
             }).then((result) => {
             if (result.isConfirmed) {
                 link = $(this).attr('data-id');
                 window.location.href = link;
             }
             })
       });
 
 </script>
    @if (session('user_del'))
         <script>
             Swal.fire(
                 'Deleted!',
                 'Your user has been deleted.',
                 'success'
                 )
         </script>
     
    @endif
@endsection