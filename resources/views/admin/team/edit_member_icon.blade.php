@extends('layouts.dashboard')

@section('content')
    <div class="row mt-4">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Add Member Icon</h4>
                </div>
                <div class="card-body">
                    @php
                        $fonts = array(
                        'fa-brands fa-facebook-f',
                        'fa-brands fa-twitter',
                        'fa-brands fa-linkedin',
                        'fa-brands fa-instagram',
                        'fa-brands fa-pinterest-p',
                        'fa-brands fa-youtube',
                        );       
                    @endphp
                    
                    <form action="{{route('member.icon.update')}}" method="POST">
                        @csrf
                        @if (session('icon'))
                                <div class="alert alert-success">{{session('icon')}}</div>
                        @endif
                        <div class="mb-3">
                            @foreach ($fonts as $font)
                                <i style="font-size: 24px; margin-right: 10px; color: red; cursor: pointer;" class="{{$font}} fa"></i>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label>Select Icon</label>
                            <input type="hidden"  name="icon_id" value="{{$icon_info->id}}">
                            <input type="text" class="form-control" name="icon" id="icon" value="{{$icon_info->icon}}">
                        </div>
                        <div class="mb-3">
                            <label>Icon Link</label>
                            <input type="text" name="icon_link" class="form-control" value="{{$icon_info->icon_link}}">
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Add Icon</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer_script')
<script>
    $('.fa').click(function(){
        var icon = $(this).attr('class');
        $('#icon').attr('value', icon);
    });
    </script>
@endsection