@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Reply  Comment</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('comment.reply.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Comment</label>
                            <textarea class="form-control">{{$comment_info->comment}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Reply</label>
                            <input type="hidden" name="comment_id" value="{{$comment_info->id}}">
                            <textarea name="reply" class="form-control">{{$comment_info->reply}}</textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Reply</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection