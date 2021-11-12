@extends('layouts.admin')

@section('title', 'Users managed page')



@section('content')

<h3><a href="categories/add"> Add Category</a></h3>

<x-auth-validation-errors class="mb-4" :errors="$errors" />
<table class='table-responsive bg-light'>

    <tr class="border border-2">

        <th class="col-1">
            ID&nbsp <a href="{{route('admin_categories',0)}}">&#8593;</a>&nbsp<a href="{{route('admin_categories',1)}}">&#8595;</a>
        </th>
        <th class="col-1">
            Name&nbsp <a href="{{route('admin_categories',2)}}">&#8593;</a>&nbsp<a href="{{route('admin_categories',3)}}">&#8595;</a>
        </th>
        <th class="col-1">
            Avatar

        </th>
        <th class="col-1">
            Active
        </th>


        <th class="col-1">
            Action
        </th>

    </tr>
    @foreach($categories as $cat)
    <tr class='border border-2'>


        <td class="col-1">
            {{$cat['id']}}
        </td>
        <td class="col-1">
            {{$cat['name']}}
        </td>
        <td class="col-1">
            <img class="cat_avatar_table" src="{{ $cat['avatar']}}" alt="">
        </td>




        <td class="col-1">

            @if($cat['active']==1) Active
            @else No-Active
            @endif
        </td>

        <td class="col-1">
            <a class="button btn-primary border rounded mx-1 my-1" href="{{route('category_edit',$cat['id'])}}">EDIT</a>
            <a id="btn_delete" class="button btn-primary border rounded" onclick="return confirm('Are you sure?')" href="{{route('category_delete',$cat['id'])}}">DELETE <i class="fa fa-trash"></i></a>




        </td>

    </tr>
    @endforeach

</table>







@endsection


@section('script')

<script src="{{asset('js/delete.js') }}"> </script>

@endsection