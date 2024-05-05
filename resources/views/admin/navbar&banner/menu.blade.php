@extends('layouts.dashboard')

@section('content')
    @can('menu_list')

    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Menu List</h4>
                </div>
                <div class="card-body">
                    @if (session('menu_del'))
                        <div class="alert alert-success">{{session('menu_del')}}</div>
                    @endif
                    <table class="table table-striped">
                        <tr>
                            <th>SL</th>
                            <th>Menu Name</th>
                            <th>Menu List</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($menus as $sl=>$menu)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$menu->menu_name}}</td>
                                <td>{{$menu->menu_link}}</td>
                                <td>
                                    <a href="{{route('menu.edit', $menu->id)}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route('menu.delete', $menu->id)}}" class="btn btn-danger">Delete</a>
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
                    <h4>Add New Menu</h4>
                </div>
                <div class="card-body">
                    @if (session('menu'))
                        <div class="alert alert-success">{{session('menu')}}</div>
                    @endif
                    <form action="{{route('menu.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Menu Name</label>
                            <input type="text" class="form-control" name="menu_name">
                            @error('menu_name')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Menu Link</label>
                            <input type="text" class="form-control" name="menu_link">
                            @error('menu_link')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Add Menu</button>
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
