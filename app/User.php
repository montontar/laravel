<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Storage;
use App\Profile;
use App\Follow;
use App\Post;
use App\Comment;
use App\PostDetail;
use Auth;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'username', 
        'email', 
        'password',
        'images',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getprofile(){
        return Storage::url($this->path);
    }
    
    public function Follows(){
        return $this->hasMany( Follow::class, 'user_id_follow', 'id');
    }

    public function Posts(){
        return $this->hasMany( Post::class, 'user_id', 'id');
    }

    public function PostsDetail(){
        return $this->hasMany( Post::class, 'user_id', 'id');
    }

    public function Comments(){
        return $this->hasMany( Comment::class, 'comment_table_id', 'id');
    }

    public function checkFollow($id){
        // dd($this->id, $id);
        $user_id = Auth::user()->id;
        $follow = Follow::where([
            'user_id'=> $user_id,
            'user_id_follow'=>$id
        ])->first();

        
        return $follow;
    }

    public function checkFollowing(){
        // dd($this->id, $id);
        $follow = Follow::whereNull('user_id_follow')->get();

        return $follow;
    }
}
