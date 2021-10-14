
@extends('layouts.admin')

@section('title', 'Users managed page')



@section('content')

<div class=' d-flex justify-content-center border border-2 rounded border-warning p-2'> 


      
      

      

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('post_edit',$post_detail['id']) }}" enctype="multipart/form-data" class='border border-1 p-5 rounded mx-2'> 
            @csrf
            <input id="id" class="block mt-1 w-full" type="hidden" name="id" value="{{ $post_detail['id'] ?? '' }}" required autofocus />
          
            <div class="row">
                <x-label class="col-3" for="title" :value="__('Title')" />

                <x-input id="title" class="block mt-1 w- col-8" type="text" name="title" value="{{$post_detail['title']}}" required autofocus />
            </div>
            <div>
                <x-label for="description" :value="__('Description')" />

                <!-- <x-input id="description" class="block mt-1 w-full" type="text" name="description" :value="$post_detail['description']"  /> -->
                <textarea class="form-control" id="description" name="description">{{$post_detail['description']}}</textarea>
            </div>
            
            <div>
                <x-label for="content" :value="__('Content')" />

                <textarea class="form-control" id="content" name="content"> {{$post_detail['content']}}</textarea>
            </div>


           
            <div class="row mt-2">
                
            <x-label  class='col-3' for="price" :value="__('Price')" />
                <x-input id="price" class="block mt-1 " type="text" name="price" :value="$post_detail['price']" required />
            </div>
            <div class="row mt-2">
            <x-label  class='col-3' for="category_id" :value="__('Category ID')" />

                    <select id="category_id" name="category_id">
                                @foreach($cats as $cat)

                                            
                                        <option value="{{$cat['id']}}" 
                                        
                                            @if($cat['id']==$post_detail['category_id']) selected
                                            @endif
                                        >{{$cat['name']}}</option>
                            @endforeach
                   
                    </select>
            </div>

            
            <div class="row mt-2">
                               
                                <label class="col-3" for="active" :value="__('Active')" > Active Status</label>
                                @if($post_detail['status'] == 1)
                                <input id="active" class="block mt-1 w-full" type="radio" name="status" value=1 checked  />
                                @else
                                <input id="active" class="block mt-1 w-full" type="radio" name="status" value=1  />
                                @endif
                               
                                <label for="unactive" class="col-2"> Active</label>
                                @if($post_detail['status'] == 1)
                                    <input id="unactive" class="block mt-1 w-full" type="radio" name="status" value=0 />
                                @else
                                    <input id="unactive" class="block mt-1 w-full" type="radio" name="status" value=0 checked />
                                @endif

                                <label for="unactive" > Un-Active</label>
                               

                            </div>
             <div>
            
           
             <div class="row mt-2">
             <label for="image"  class="col-3"> Avatar</label>
                                <img class="cat_avatar" src="{{asset('uploads/images/'. $post_detail['avatar'])}}" alt="">
                                              <input type="file" name="image" class="form-control mt-2 ">
             </div>

            <div class="flex items-center justify-end mt-4">
              

                <x-button class="ml-4 btn btn-primary">
                    {{ __('Update Post') }}
                </x-button>
            </div>
        </form>
  

@endsection

@section('script')

<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'content', {
    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
});
</script>
@endsection