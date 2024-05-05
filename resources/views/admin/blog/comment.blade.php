@extends('layouts.dashboard')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Blog Comment List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Comment</th>
                            <th>Action</th>
                        </tr>

                        @foreach ($comments as $sl=>$comment)
                            <tr>
                                <td>{{$sl+1}}</td>
                                <td>{{$comment->name}}</td>
                                <td>{{Substr($comment->comment, 0, 30)}}..more</td>
                                <td>
                                    <a href="{{route('comment.reply', $comment->id)}}" class="btn btn-success">Reply</a>
                                    <a href="{{route('comment.delete', $comment->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td>{{$comments->links()}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection