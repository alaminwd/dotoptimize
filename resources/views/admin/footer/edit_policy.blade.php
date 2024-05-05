@extends('layouts.dashboard')

@section('content')
    @can('edit_privacy_policy')
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Privacy policy </h3>
                </div>
                <div class="card-body">
                    <form action="{{route('policy.update')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label>Privacy Policy</label>
                            <input type="hidden" name="policy_id" value="{{$policy_info->id}}">
                            <textarea id="summernote" name="desp">{{$policy_info->desp}}</textarea>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Update Policy</button>
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
    $('#summernote').summernote();
</script>
@endsection