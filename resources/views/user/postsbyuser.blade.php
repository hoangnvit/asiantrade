@extends('layouts.master')

@section('title', "user's post page")

@section('sidebar')
	@parent

	
@endsection

@section('content')

<h4 class='text-success text-capitalize'><u>{{$user->username}}</u></h4>
      
	 

	  <x-list-post class="mb-4" :posts="$posts" :action=1 />

	  
@endsection






