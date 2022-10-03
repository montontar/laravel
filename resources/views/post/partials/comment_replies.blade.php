<style>
    .display-comment .display-comment {
        margin-left: 40px
    }
</style>

                    

    @foreach($comments as $comment)
        <div class="display-comment ml-5">
            @if(Auth :: user()->id == $comment->user_id) 
                <img src="{{ Auth :: user()->getprofile() }}" class="img-rounded zoom img-thumbnail img-responsive" 
                    style="background-color:MediumSeaGreen; border-radius: 50px; display: cover; max-width: 6%; max-height: 6%;">
                    <strong>{{ Auth :: user()->name }}   </strong>
            @else
                <img src="{{ $comment->user->getprofile() }}" class="img-rounded zoom img-thumbnail img-responsive" 
                    style=" border-radius: 50px; display: cover; max-width: 5%; max-height: 5%;">
                    <strong>{{ $comment->user->name }}</strong>
            @endif                            
            <p>{{ $comment->body }}</p>
            <h7>{{ __('เวลาโพส : ') }}{{ $comment->updated_at }}</h7>

            <a href="" id="reply"></a>
            <form method="post" action="{{ route('reply.add') }}">
                @csrf
                <div class="form-group mt-2">
                    <input type="text" name="comment_body" class="form-control" placeholder="ตอบกลับ ..."/>
                    <input type="hidden" name="post_id" value="{{ $post_id }}" />
                    <input type="hidden" name="comment_id" value="{{ $comment->id }}" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info" value="ตอบกลับ" />
                </div>
            </form>
            @include('post.partials.comment_replies', ['comments' => $comment->replies])
        </div> 
    @endforeach

