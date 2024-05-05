@extends('layouts.dashboard')

@section('content')
    @can('member_skills')
    <div class="row mt-3">
        <div class="col-lg-8">
            <div class="row">
                @foreach ($members as $member)
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>{{$member->name}}</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Skill</th>
                                    <th>Percentage</th>
                                    <th>Action</th>
                                </tr>
                                @php
                                    $skills = App\Models\Teamskill::where('member_id', $member->id)->get();
                                @endphp
                                @foreach ($skills as $skill)
                                    <tr>
                                        <td>{{$skill->skill}}</td>
                                        <td>{{$skill->percent}}%</td>
                                        <td>
                                            <div class="dropdown mb-3">
                                                <a href="javascript:void(0)" class="more-button" data-toggle="dropdown" aria-expanded="false">
                                                    <svg width="6" height="26" viewBox="0 0 6 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M6 3C6 4.65685 4.65685 6 3 6C1.34315 6 0 4.65685 0 3C0 1.34315 1.34315 0 3 0C4.65685 0 6 1.34315 6 3Z" fill="#585858"></path>
                                                        <path d="M6 13C6 14.6569 4.65685 16 3 16C1.34315 16 0 14.6569 0 13C0 11.3431 1.34315 10 3 10C4.65685 10 6 11.3431 6 13Z" fill="#585858"></path>
                                                        <path d="M6 23C6 24.6569 4.65685 26 3 26C1.34315 26 0 24.6569 0 23C0 21.3431 1.34315 20 3 20C4.65685 20 6 21.3431 6 23Z" fill="#585858"></path>
                                                    </svg>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="{{route('member.skill.edit', $skill->id)}}" class="dropdown-item">Edit</a>
                                                    <a href="{{route('member.skill.delete', $skill->id)}}" class="dropdown-item">Delete</a>
                                                </div>
                                            </div>
                                        
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add member skill</h3>
                </div>
                @if (session('skill'))
                    <div class="alert alert-success">{{session('skill')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('member.skill.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Member Name</label>
                            <select name="member_id" class="form-control">
                                <option value="">--select member--</option>
                                @foreach ($members as $member)
                                <option value="{{$member->id}}">{{$member->name}}</option>
                                @endforeach
                            </select>
                            @error('member_id')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Skill Name</label>
                            <input type="text" name="skill" class="form-control">
                            @error('skill')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Percenteage</label>
                            <input type="number" name="percent" class="form-control">
                            @error('percent')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Add skill</button>
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