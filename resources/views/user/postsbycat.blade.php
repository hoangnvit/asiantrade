@extends('layouts.master')

@section('title', 'Post by Cat3egory')

@section('sidebar')
	@parent

	
@endsection

@section('content')

<h4 class='text-success text-capitalize'><u>{{$cat->name}}</u></h4>
      
	 

	  <x-list-post class="mb-4" :posts="$posts" />

	  
@endsection






