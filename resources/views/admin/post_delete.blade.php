@extends('layouts.master')

@section('title', "Admin's post delete page")



@section('content')

<div class=' d-flex justify-content-center'>
<x-auth-validation-errors class="mb-4" :errors="$errors" />
    <h5 class="text-warning">You are deleting post: "{{$post['title']}}"</h5>

</div>

<div class=' d-flex justify-content-center border border-2 rounded border-warning p-2'>







    <!-- Validation Errors -->
    

    <form method="POST" action="{{route('admin_posts_delete',['user_id'=>$post['user_id'], 'post_id'=>$post['id']])}}" enctype="multipart/form-data" class='border border-1 p-5 rounded mx-2'>
        @csrf
        <!-- <input id="id" class="block mt-1 w-full" type="hidden" name="id" value="{{ $post_detail['id'] ?? '' }}" required autofocus /> -->
        
        <div class="row mt-2">
            <x-label class="col-4" for="reason_id" :value="__('Reason')" />

            <select class="col-4" id="reason_id" name="reason_id">
                @foreach($reasons as $r)
                <option value="{{$r['id']}}">{{$r['reason']}}</option>
                @endforeach

            </select>
        </div>

            <div class="flex items-center justify-end mt-4">


                <x-button class="ml-4 btn btn-primary">
                    {{ __('Delete Post') }}
                </x-button>
            </div>
    </form>
</div>


@endsection

@section('script')

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('content', {
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
@endsection