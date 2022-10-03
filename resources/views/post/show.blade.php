@extends('layouts.index')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        
        <div class="col-md-10">
        <a href="/post" class="btn btn-success  my-2 col-2"> กลับ </a>
            <div class="card">
                
                <div class="card-header">โพส</div>
                <div class="card-body">
                    <h3 class="ml-2">หัวข้อ :: {{ $posts->title }}</h3>
                        @if( !$posts->images == "")
                                    <img src="{{ $posts->getprofile() }}" class="col-10  img-responsive ml-4" style="display: cover; max-width: 60%; max-height: 40%;">
                        @endif
                    <p class="ml-4 mt-4">
                                {{ $posts->body }}
                    </p>
                    
                    <hr />

                    <h4 class="ml-4">Comment</h4>
                    
                            @include('post.partials.comment_replies', ['comments' => $posts->comments, 'post_id' => $posts->id])
                    
                    <hr />

                    <form method="post" action="{{ route('comment.add') }}">
                                @csrf
                                <div class="form-group col-10">
                                    <input type="text" name="comment_body" class="form-control col-12"  placeholder="คอมเม้นต์ ..."/>
                                    <input type="hidden" name="post_id" value="{{ $posts->id }}" />
                                </div>
                                <div class="form-group ml-3">
                                    <input type="submit" class="btn btn-warning" value="คอมเม้นต์" />
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
