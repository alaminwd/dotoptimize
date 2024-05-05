@extends('layouts.dashboard')

@section('content')
    @can('add_service')
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h3 class="text-white ml-auto mr-auto">Add service</h3>
                </div>
                @if (session('service'))
                    <div class="alert alert-success">{{session('service')}}</div>
                @endif
                <div class="card-body">
                    @php
                    $fonts = array(
                        'fa-solid fa-briefcase',
                        'fa-regular fa-file-lines',
                        'fa-solid fa-sack-dollar',
                        'fa-solid fa-database',
                        'fa-solid fa-calculator',
                        'fa-brands fa-artstation',
                        'fa-solid fa-pen-nib',
                        'fa-regular fa-folder-open',
                        'fa-brands fa-codepen',
                        'fa-solid fa-door-open',
                        'fa-solid fa-pen-ruler',
                        'fa-regular fa-hourglass-half',
                        );       
                    @endphp
                    <form action="{{route('service.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            @foreach ($fonts as $font)
                                <i style="font-size: 24px; margin-right: 10px; color: red; cursor: pointer;" class="{{$font}} fa"></i>
                            @endforeach
                        </div>
                        <div class="mb-3">
                            <label>Select Icon</label>
                            <input type="text" class="form-control" name="icon" id="icon">
                            @error('icon')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title">
                            @error('title')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Short Description</label>
                            <input type="text" class="form-control" name="short_desp">
                            @error('short_desp')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Short Description</label>
                            <textarea name="long_desp" id="summernote"></textarea>
                            @error('long_desp')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Keyword</label>
                            <input type="text" name="keyword" class="form-control">
                            @error('keyword')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>service Image</label>
                            <input type="file" class="form-control" name="image">
                            @error('image')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                            @if (session('photo_error'))
                                <strong class="text-danger">{{session('photo_error')}}</strong>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-lg-4 m-auto">
                                <div class="mb-3">
                                    <button class="btn bg-primary text-white form-control" type="submit">Add service</button>
                                </div>
                            </div>
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

@section('footer_script')
<script>
    $('.fa').click(function(){
        var icon = $(this).attr('class');
        $('#icon').attr('value', icon);
    });
    </script>

<script>
    $('#summernote').summernote();
</script>
@endsection