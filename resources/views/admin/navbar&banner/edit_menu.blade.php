@extends('layouts.dashboard')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-4 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Menu</h4>
                </div>
                <div class="card-body">
                    @if (session('menu_up'))
                        <div class="alert alert-success">{{session('menu_up')}}</div>
                    @endif
                    <form action="{{route('menu.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Menu Name</label>
                            <input type="hidden" name="menu_id" value="{{$menus_info->id}}">
                            <input type="text" class="form-control" name="menu_name" value="{{$menus_info->menu_name}}">
                        </div>
                        <div class="mb-3">
                            <label>Menu Link</label>
                            <input type="text" class="form-control" name="menu_link" value="{{$menus_info->menu_link}}">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Update Menu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection