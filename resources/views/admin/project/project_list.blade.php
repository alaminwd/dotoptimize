@extends('layouts.dashboard')

@section('content')
    @can('project_list')
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Project List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Title</th>
                            <th>Client</th>
                            <th>Date</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($projects as $sl=>$project)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$project->title}}</td>
                                <td>{{$project->client}}</td>
                                 <td>
                                    @php
                                        if ($project->updated_at == null) {
                                            echo $project->created_at->format('M-d,Y');
                                        }
                                        else {
                                            echo $project->updated_at->format('M-d,Y');
                                        }
                                    @endphp
                                </td>
                                <td>
                                    <img width="80" src="{{asset('upload/project')}}/{{$project->image}}" alt="">
                                </td>
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
                                            <a href="{{route('project.price', $project->id)}}" class="dropdown-item">Add Price</a>
                                            <a href="{{route('project.edit', $project->id)}}" class="dropdown-item">Project Update</a>
                                            <a href="{{route('project.delete', $project->id)}}" class="dropdown-item">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    @else
    <h4 class="text-danger">Unfortunately, you don't have access For this page.</h4>
    @endcan
@endsection