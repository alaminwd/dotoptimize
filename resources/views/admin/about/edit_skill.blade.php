@extends('layouts.dashboard')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Update Skill Info</h3>
                </div>
                @if (session('skill'))
                    <div class="alert alert-success">{{session('skill')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('skill.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Skill Name</label>
                            <input type="hidden" name="skill_id" value="{{$skill_info->id}}">
                            <input type="text" class="form-control" name="skill" value="{{$skill_info->skill}}">
                        </div>
                        <div class="mb-3">
                            <label>Skill Percentage</label>
                            <input type="number" class="form-control" name="percent" value="{{$skill_info->percent}}">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary">Update Skill</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection