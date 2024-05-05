@extends('layouts.dashboard')

@section('content')
    @can('skill_list')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Skill List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Skill Name</th>
                            <th>Percentage</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($skills as $sl=>$skill)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{substr($skill->skill, 0, 15)}} <a href="{{route('skill.edit', $skill->id)}}">..more</a> </td>
                                <td>{{$skill->percent}}%</td>
                                <td>
                                    <a href="{{route('skill.edit', $skill->id)}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route('skill.delete', $skill->id)}}" class="btn btn-danger">Delete</a>
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
                    <h3>Add Skill</h3>
                </div>
                @if (session('skill'))
                    <div class="alert alert-success">{{session('skill')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('skill.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Skill Name</label>
                            <input type="text" class="form-control" name="skill">
                            @error('skill')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Skill Percentage</label>
                            <input type="number" class="form-control" name="percent">
                            @error('percent')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Add Skill</button>
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