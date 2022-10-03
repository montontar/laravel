@extends('layouts.index')

<link rel="stylesheet" href=
            "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
                    integrity=
            "sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
                    crossorigin="anonymous">
    <style>
                    /* Content of modal div is center aligned */
                    /**THE SAME CSS IS USED IN ALL 3 DEMOS**/    
            /**gallery margins**/  
            ul.gallery{    
            margin-left: 3vw;     
            margin-right:3vw;  
            }    

            .zoom {      
            -webkit-transition: all 0.35s ease-in-out;    
            -moz-transition: all 0.35s ease-in-out;    
            transition: all 0.35s ease-in-out;     
            cursor: -webkit-zoom-in;      
            cursor: -moz-zoom-in;      
            cursor: zoom-in;  
            }     

            .zoom:hover,  
            .zoom:active,   
            .zoom:focus {
            /**adjust scale to desired size, 
            add browser prefixes**/
            -ms-transform: scale(3.0);    
            -moz-transform: scale(3.0);  
            -webkit-transform: scale(3.0);  
            -o-transform: scale(3.0);  
            transform: scale(3.0);    
            /* position:relative;       */
            z-index:100;  
            }

            /**To keep upscaled images visible on mobile, 
            increase left & right margins a bit**/  
            @media only screen and (max-width: 1000px) {   
            ul.gallery {      
            margin-left: 15vw;       
            margin-right: 15vw;
            }

            /**TIP: Easy escape for touch screens,
            give gallery's parent container a cursor: pointer.**/
            .DivName {cursor: pointer}
            }
    </style>


  @section('content')
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <main class="main-content position-relative border-radius-lg ">
            <div class="container">
                    @error('comment_body')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                <div class="row justify-content-center">
                    <div class="col-md-12">

                        <div class="card">
                            <div class="card-header">
                                <h3> {{ __('New Post') }} </h3>
                            </div>
                        </div>

                        @foreach($posts as $post)
                        <div class="card mt-4">
                            @if(Auth :: user()->id == $post->user_id) 
                                <h4 class="ml-3 mt-3"> <img src="{{ Auth :: user()->getprofile() }}" class="img-rounded zoom img-thumbnail img-responsive" 
                                        style="background-color:MediumSeaGreen; border-radius: 50px; display: cover; max-width: 6%; max-height: 6%;"> {{ Auth :: user()->name }}   </h4>
                            @else
                                <h4 class="ml-3 mt-3"> <img src="{{ $post->user->getprofile() }}" class="img-rounded zoom img-thumbnail img-responsive" 
                                        style="border-radius: 50px; display: cover; max-width: 6%; max-height: 6%;"> {{ $post->user->name }}   </h4>   
                            @endif
                            <div class="card-body">
                               @if( !$post->images == "")
                                    <div align="center">
                                        <img src="{{ $post->getprofile() }}" class="col-10  img-responsive ml-4" style="display: cover; max-width: 60%; max-height: 40%;">
                                    </div>
                               @endif
                                    <p class="ml-5 mt-3" >{{ $post->body }}</p>

                            @if( $post->PostsDetails->isEmpty())
                              
                                {!! Form::open(['action' => ['PostController@update',$post->id],'id' =>'frmposts','name' =>'frmposts','method' =>'PUT', 'enctype' => 'multipart/form-data']) !!}
                                {{ csrf_field() }}
                                    <button class="ml-4" style="border: none; font-size:25px; width: 40px;" id="is_status" name="is_status" type="submit" data-id="{{$post->id}}" value="{{$post->id}}">
                                        <i  class="fas fa-heart " style="font-size:25px;"  ></i>
                                    </button>
                                {!! Form::close() !!} 
                            @else
                                @if($post->checkPostsDetail($post->id) == "")
                                    {!! Form::open(['action' => ['PostController@update',$post->id],'id' =>'frmposts','name' =>'frmposts','method' =>'PUT', 'enctype' => 'multipart/form-data']) !!}
                                    {{ csrf_field() }}
                                        <button class="ml-4" style="border: none; font-size:25px; width: 40px;" id="is_status" name="is_status" type="submit" data-id="{{$post->id}}" value="{{$post->id}}">
                                            <i  class="fas fa-heart " style="font-size:25px;"  ></i>
                                        </button>
                                    {!! Form::close() !!} 
                                @else
                                    <form method="post" action="{{route('newfeed.destroy',$post->checkPostsDetail($post->id)->id)}}">
                                    @method('delete')
                                    @csrf
                                        <button class="ml-4 dislike" style="border: none; font-size:25px; width: 40px;" id="dislike" name="dislike" type="submit" data-id="{{ $post->checkPostsDetail($post->id)->id }}" value="0">
                                            <i  class="fas fa-heart " style="font-size:25px; color: red;"  ></i>
                                        </button>
                                    </form>
                                @endif
                            @endif
                                </form> 
                                    <div align="right" class="mr-2"><h7>{{ __('เวลาโพส : ') }}{{ $post->updated_at }}</h7></div>
                                <hr />
                                    @include('post.partials.comment_replies', ['comments' => $post->comments, 'post_id' => $post->id])
                                <hr />

                                <form method="post" action="{{ route('comment.add') }}">
                                    @csrf
                                        <div class="form-group col-10 mt-2">
                                                <img src="{{ Auth :: user()->getprofile() }}" class="img-rounded zoom img-thumbnail img-responsive" 
                                                        style="background-color:MediumSeaGreen; border-radius: 50px; display: cover; max-width: 4%; max-height: 4%;">
                                                <h7 style="font-size: 12px;" class="mt-2">{{ Auth :: user()->name }}   </h7>
                                                <input type="text" name="comment_body" class="form-control col-12 mt-2"  placeholder="คอมเม้นต์ ..."/>
                                                <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                           
                                        </div>
                                        <div class="form-group ml-3">
                                            <input type="submit" class="btn btn-warning" value="คอมเม้นต์" />
                                        </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        
                                
  </main>
  @endsection





