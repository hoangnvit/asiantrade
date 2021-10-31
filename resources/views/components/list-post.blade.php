@props(['posts','action'=>0])

@foreach($posts as $post)
	 <div class='row-12 border rounded border-warning mb-1 border-1 d-flex'>
			 <div class='col-8 border'>

					  <h5 ><a class="text-capitalize" href="{{route('post',$post['id'])}}">{{$post['title']}}</a></h5> <hr>
					  <p><i class="text-capitalize">author: {{$post->user->username}} &nbsp; created at: {{$post['created_at']}}</i></p>
					  <hr>
					  <div>
					  <p>{{$post['description']}}</p>
					  </div>
			  </div>

			  <div class='col-4 border text-center' >
					  
					
							  <img class='product_avatar ' src="{{$post['avatar']}}"alt='picture of product'>
							  <br/>
					  <h5 class='text-primary'>{{$post['price']}}&#36;</h5>
					  @if($action==1)
							  <a class="button btn-primary border rounded mx-1 my-1 p-1" href="{{route('user_posts_detail',['user_id'=>$post->user->id,'post_id'=>$post['id']])}}">EDIT</a>
							  <a class="button btn-primary border rounded mx-1 my-1 p-1" href="{{route('user_posts_detail',['user_id'=>$post->user->id,'post_id'=>$post['id']])}}">DELETE</a>
                   				 <!-- <a  id="btn_delete" class="button btn-primary border rounded p-1" onclick="return confirm('Are you sure?')" href="{{route('user_posts_delete',['user_id'=>$post['user_id'], 'post_id'=>$post['id']])}}">DELETE <i class="fa fa-trash"></i></a> -->
                       
					 @endif
			  </div>
	  </div>
      <div>{{$posts->links()}}</div>

	  @endforeach
