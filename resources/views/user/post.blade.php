@extends('layouts.master')

@section('title', 'Posts Detail')
@section('meta')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('sidebar')
	@parent

	
@endsection

@section('content')
<h4 class='text-success text-capitalize'><u> <a href="{{route('cat_posts',$cat->id)}}"> {{$cat->name}}</a></u></h4>
         <div class='border rounded border-warning m-2 p-2'>
          
			<h5 class='text-primary'><u>{{$post['title']}}</u></h5>
			<p> Author: {{$author->username}}<br>Created time:{{ $post['created_at']}}</p> <hr>
			
			

			<div class='image_responsive'><?php echo $post['content']?></div>
          
        
         </div>
         <div class="card-body">
                <h5 class="btn btn-info" onclick="toggle_message()">Contact: {{$post->user->username}}</h5>
                
                <form  id="message_form" class="d-none col-8 mx-auto">
                <div id="message_return"></div>
                @csrf
                <div class="form-group">
                  <div class="row mt-2">
                <x-label class="col-3" for="title" :value="__('Title:')" />
                    <input type="text" id="title" name="title" class="form-control" />
                    </div>
                    <div class="row mt-2">
                    <x-label class="col-3" for="message" :value="__('Message:')" />
                    <textarea class="form-control" id="message" name="message"> </textarea>
                    <input type="hidden" name="receiver_id" id="receiver_id" value="{{$post['user_id'] }}" />
                    </div>
                </div>
                <div class="form-group">
                    <!-- <input type="submit" class="btn btn-warning" value="SEND" /> -->
                    <button class="btn btn-warning" id="btn_send" onclick="send()">Send</button>
                </div>
            </form>
</div>      

         <div class="card-body">
                <h5>Display Comments</h5>
                <hr>
            
                @include('user.partials.replys', ['comments' => $post->comments, 'post_id' => $post->id])
            

                <hr />
               </div>

               

               <!-- <h4>Add comment</h4> -->
                    <form class="mx-2" method="post" action="{{ route('comment.add') }}">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="comment_body" class="form-control" />
                            <input type="hidden" name="post_id" value="{{ $post->id }}" />
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-warning" value="Add Comment" />
                        </div>
                    </form>
               </div>
         
@endsection



@section('script')

<script>
function like(commentId){

  console.log(commentId);

  $.ajax({
      
      
      url: '{{ URL::route('comment.like', 'commentId') }}',
      type: "GET",
      data: {comment_id:commentId},
      success: function(response) {
        console.log(response);
          if(response[0]==0) alert("You liked already!");
          else if(response[0]==1){

            $("#like-"+commentId).html("Like: "+response[1]);
          }
          else alert('You need to login to like');
      }
    });

}



function toggleReply(commentId){
    // console.log("Click");

   
    
    $.ajax({
      url: "{{route('stt')}}",
      type: "GET",
      
      success: function(response) {
          if(response==1) {
            
            $(".reply-form-"+commentId).toggleClass('d-none');
          } else alert("You need to login to use Comment function!");
      }
    });
  
}

function toggleEdit(commentId){
    

   
    
    $.ajax({
      url: "{{route('stt')}}",
      type: "GET",
      success: function(response) {
          if(response==1) {
            
            $(".edit-form-"+commentId).toggleClass('d-none');
          } else alert("You need to login to use Comment function!");
      }
    });
  
}


function toggle_message(){
 
  $.ajax({
      url: "{{route('stt')}}",
      type: "GET",
      success: function(response) {
          if(response==1) {
            
            $('#message_form').toggleClass('d-none');
            $("#message_return").html("");

          } else alert("You need to login to use Message function!");
      }
    });


}

function send(){

  event.preventDefault();
  // console.log("Send clicked");
  title=$('#title').val();
  message=$('#message').val();
  receiver_id=$('#receiver_id').val();
  // console.log(title);
  // console.log(message);
  // console.log(receiver_id);
  if((title.length>10)&& (message.length>10)) {

  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

  $.ajax({
      url: "{{route('message.save')}}",
      type: "POST",
      data:{title:title, message:message, receiver_id:receiver_id},
      success: function(response) {
          if(response){
             $("#message_return").html("<p class='text-info'>Message is sent. </p>");
              
              $('#title').val('');
              $("#message").val('');
          }
          else $("#message_return").html('  Sent Message Fail .')
      }
    });
  } else{
    $("#message_return").html("<p class='text-danger'> Title  and message must be more than 10 characters. </p>")
    
  }

}


</script>

@endsection


