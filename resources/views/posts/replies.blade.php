@foreach($comments as $comment)
<div class="display-comment"  style="margin-left:20px">
    <br>
    <strong>{{ $comment->user->name }}</strong>
    <p>{{ $comment->comment }}</p>
    <a href="#collapseExample{{ $comment->id }}" data-toggle="collapse"  id="reply">Reply</a>

<div class="collapse" id="collapseExample{{ $comment->id }}">

    <form method="post" action="{{ route('reply.add') }}">
        @csrf
        <div class="form-group">
            <input type="text" name="comment" class="form-control"  placeholder="Enter comment.." required/>
            <input type="hidden" name="post_id" value="{{ $post_id }}"  />
            <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Reply" />
        </div>
    </form>
    </div>
    @include('posts.replies', ['comments' => $comment->replies])
</div>
@endforeach