@extends('layouts.admin')

@section('title', 'Users managed page')

@section('content')


<div class='d-flex d-flex justify-content-center border border-2 rounded border-warning p-2'>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('post_store') }}" enctype="multipart/form-data" class='border border-1 p-5 rounded mx-2'>
        @csrf


        <div class="row mt-2">
            <x-label class='col-4' for="title" :value="__('Title')" />

            <x-input id="title" class="block mt-1" type="text" name="title" :value="old('title')" required autofocus />
        </div>
        <div class="row mt-2">
            <x-label class="col-4" for="description" :value="__('Description')" />

            <!-- <x-input class="col-8" id="description" class="block mt-1" type="text" name="description" :value="old('description')"  /> -->
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <div class="row mt-2">
            <x-label class="col-4" for="content" :value="__('Content')" />

            <textarea class="form-control col-8" id="content" name="content"></textarea>
        </div>


        <div class="row mt-2">

            <x-label class="col-4" for="price" :value="__('Price')" />
            <x-input class="col-8" id="price" class="block mt-1 w-full" type="text" name="price" :value="old('price')" required />
        </div>
        <div class="row mt-2">
            <x-label class="col-4" for="category_id" :value="__('Category ID')" />

            <select id="category_id" name="category_id">
                @foreach($cats as $cat)
                <option value="{{$cat['id']}}">{{$cat['name']}}</option>
                @endforeach

            </select>
        </div>

        <div class="row mt-2">
            <label class="col-4" for="active" :value="__('Active')"> Active Status</label>

            <input id="active" class="block mx-1" type="radio" name="active" value=1 checked />
            <label for="active" class="mx-1"> Active</label>
            <input id="admin" class="block mx-1" type="radio" name="active" value=0 />
            <label for="unactive"> Un-Active</label>
        </div>
        <div>

            <div class="row">
                <label class="col-4" for="image"> Avatar</label>
                <input class="col-8" type="file" name="image" class="form-control">
            </div>

            <div class="flex items-center justify-end mt-4">


                <x-button class="ml-4 btn btn-primary">
                    {{ __('Create new Post') }}
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