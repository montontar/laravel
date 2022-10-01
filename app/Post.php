<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Comment;
use App\PostDetail;
use Storage;
use Auth;

class Post extends Model
{

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->whereNull('parent_id');
    }

    public function PostsDetails(){
        return $this->hasMany( PostDetail::class, 'posts_id', 'id');
    }

    public function checkPostsDetail($id){
        $user_id = Auth::user()->id;
        $postdetails = PostDetail::where([
            'user_id'=> $user_id,
            'posts_id'=>$id
        ])->first();

        
        return $postdetails;
    }

    public function getprofile(){
        return Storage::url($this->path);
    }
    
}
