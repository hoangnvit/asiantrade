@foreach($comments as $comment)
<div class="display-comment" style="margin-left: 40px;">
    <strong class="text-success">{{ $comment->user->username }}</strong>

    <p>{{ $comment->body }}</p>

    <a class="btn btn-primary text-white" onclick="toggleReply({{$comment->id}})"> reply</a>
    @if(Auth::check() && ( Auth::user()->id == $comment->user->id))
    <a class="btn btn-primary text-white" onclick="toggleEdit({{$comment->id}})">Edit</a>
    <a class="btn btn-primary text-white" onclick="return confirm('Are you sure?')" href="{{route('comment.delete',$comment->id)}}">Delete</a>


    @endif
    <!-- <a class="btn btn-primary like_button" href="{{route('comment.like',['comment_id'=>$comment->id])}}" id="like-{{$comment->id}}"> Like:{{$comment->likes->count()}}</a> -->
    <a class="btn btn-primary like_button text-white" onclick="like({{$comment->id}})" id="like-{{$comment->id}}"> Like:{{$comment->likes->count()}}</a>
    <hr>
    <div id="reply-form-{{$comment->id}}" class="reply-form-{{$comment->id}} d-none  style='margin-left: 40px;'">
        <form method="post" action="{{ route('reply.add') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="comment_body" class="form-control" />
                <input type="hidden" name="post_id" value="{{ $post_id }}" />
                <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Reply" />
            </div>
        </form>

    </div>

    <div id="edit-form-{{$comment->id}}" class="edit-form-{{$comment->id}} d-none  style='margin-left: 40px;'">
        <form method="post" action="{{ route('comment.edit') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="comment_body" class="form-control" value="{{ $comment->body }}" />

                <input type="hidden" name="comment_id" value="{{$comment->id }}" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-warning" value="Edit" />
            </div>
        </form>

    </div>

    @include('user.partials.replys', ['comments' => $comment->replies])
</div>


@endforeach