@extends('layouts.master')

@section('title', 'Search Page')

@section('sidebar')
@parent


@endsection

@section('content')
<form class='border border-1 p-5 rounded mx-2'>
    <div class="form-group col-6">
        <labe class='text-primary small'>
            <h4> Searching </h4></label>
            <input type="text" class="form-control" id="keyword" name='keyword' placeholder="keyword">
            <div class="col-sm-8 help-block" id="message_keyword"></div>
    </div>
    <hr>
    <div class="row">
        <x-label class="col-4 text-info" for="search_field" :value="__('Search Field:')" />

        <select class="col-4 text-info" id="search_field" name="search_field">
            <option value=0>Title</option>
            <option value=1>User</option>


        </select>
    </div>
    <div class="row mt-2 text-info">
        <x-label class="col-4" for="category_id" :value="__('Category Filter:')" />

        <select class="col-4 text-info" id="category_id" name="category_id">
            <option value=0>All</option>
            @foreach($cats as $cat)

            <option value={{$cat['id']}}>{{$cat['name']}}</option>
            @endforeach

        </select>
    </div>


    {{ csrf_field() }}
    <button id="btn_search" class="btn btn-primary"> Search</button>
</form>

<div id="search_result"></div>


@endsection

@section('script')

<script type="text/javascript" src="{{asset('js/search_script.js')}}"></script>
@endsection