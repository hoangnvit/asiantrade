@extends('layouts.admin')

@section('title', 'Users managed page')


@section('content')


<div class=' d-flex justify-content-center border border-2 rounded border-warning p-2'>

    <!-- Validation Errors -->
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('category_store') }}" enctype="multipart/form-data" class='border border-1 p-5 rounded mx-2'>
        @csrf

        <!-- Username -->
        <div>
            <x-label for="category" :value="__('Category name')" />

            <x-input id="category_name" class="block mt-1 w-full" type="text" name="name" :value="old('category')" required autofocus />
        </div>



        <div>
            <label for="active" :value="__('Active')"> Active Status</label>

            <input id="active" class="block mt-1 w-full" type="radio" name="active" value=1 checked />
            <label for="active"> Active</label>
            <input id="admin" class="block mt-1 w-full" type="radio" name="active" value=0 />
            <label for="unactive"> Un-Active</label>
        </div>
        <div>
            <label for="image"> Active</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="flex items-center justify-end mt-4">


            <x-button class="ml-4 btn btn-primary">
                {{ __('Create new Category') }}
            </x-button>
        </div>
    </form>
</div>

@endsection