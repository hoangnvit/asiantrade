@extends('layouts.master')

@section('title', 'Index page')

@section('sidebar')
@parent


@endsection

@section('content')
<div id="all_cats">




	@foreach($cats as $cat)
	<a href="{{route('cat_posts',$cat->id)}}">
		<div class='cat_block'>

			<img src="$cat->avatar}}">

			<h3> {{$cat->name}}</h3>
		</div>
	</a>

	@endforeach

</div>
@endsection