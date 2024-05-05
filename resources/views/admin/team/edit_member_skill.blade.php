@extends('layouts.dashboard')

@section('content')
    <div class="row mt-4">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit member skill</h3>
                </div>
                @if (session('skill'))
                    <div class="alert alert-success">{{session('skill')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('member.skill.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Skill Name</label>
                            <input type="hidden" name="skill_id" value="{{$skills_info->id}}">
                            <input type="text" name="skill" class="form-control" value="{{$skills_info->skill}}">
                        </div>
                        <div class="mb-3">
                            <label>Percenteage</label>
                            <input type="number" name="percent" class="form-control" value="{{$skills_info->percent}}">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Update skill</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection