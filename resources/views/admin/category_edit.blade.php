@extends('layouts.admin')

@section('title', 'Users managed page')



@section('content')


<div class=' d-flex justify-content-center border border-2 rounded border-warning p-2'>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{route('category_edit',$cat_detail['id']) }}" enctype="multipart/form-data" class='border border-1 p-5 rounded mx-2'>
        @csrf
        <input id="id" class="block mt-1 w-full" type="hidden" name="id" value="{{ $cat_detail['id'] ?? '' }}" required autofocus />
        <div class="row">
            <x-label class="col-5" for="category" :value="__('Category')" />

            <x-input class="col-7" id="category_name" class="block mt-1 w-full" type="text" name="name" value="{{$cat_detail['name']}}" required autofocus />
        </div>



        <div class="row mt-3">
            <label class="col-5" for="active" :value="__('Active')"> Active Status</label>
            <div class="col-8">
            @if ($cat_detail['active'] == 1)
   
                <input id="active" class="block mt-1 w-full" type="radio" name="active" value=1 checked />
                <label for="active"> Active</label>
                <input id="admin" class="block mt-1 w-full" type="radio" name="active" value=0  />
                <label for="unactive"> Un-Active</label>
            @else
                <input id="active" class="block mt-1 w-full" type="radio" name="active" value=1 />
                <label for="active"> Active</label>
                <input id="admin" class="block mt-1 w-full" type="radio" name="active" value=0 checked />
                <label for="unactive"> Un-Active</label>


            @endif
            </div>
        </div>
        <div class="row justify-content-center">

            <figure> <img class="cat_avatar" src="{{$cat_detail['avatar']}}" alt="">
                <figcaption> A pink flamingo.</figcaption>
            </figure>


            <br />

        </div>
        <div class="mt-2"><input type="file" name="image" class="form-control"></div>

        <div class="flex items-center justify-end mt-4">


            <x-button class="ml-4 btn btn-primary">
                {{ __('Update') }}
            </x-button>
        </div>
    </form>


</div>

@endsection