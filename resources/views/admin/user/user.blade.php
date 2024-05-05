@extends('layouts.dashboard')

@section('content')
@can('user_list')
    <div class="row mt-5">
        <div class="col-lg-8 ">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white" style="width:100%">User List <span class="float-right">Total: {{$total_user}}</span></h3>
                </div>
                <div class="card-body">
                   <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($users as $sl=>$user)
                    <tr>
                        <td>{{$sl+1}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if ($user->photo == null)
                                <img width="60" height="60" style="border-radius: 50%" src="{{ Avatar::create($user->name)->toBase64()}}"/>
                                @else
                                <img width="60" height="60" style="border-radius: 50%" src="{{asset('upload/user')}}/{{$user->photo}}" alt="">
                            @endif
                        </td>
                        <td>
                            <button data-id="{{route('user.delete', $user->id)}}" class="d_btn btn btn-danger">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                   </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Create User</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="mb-1 text-white"><strong>Name</strong></label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Your Name">
        
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="mb-1 text-white"><strong>Email</strong></label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Your Email">
        
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="mb-1 text-white"><strong>Password</strong></label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
        
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary">create user</button>
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