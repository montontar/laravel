<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Post;
class PostDetail extends Model
{
    protected $fillable = [
        'user_id',
        'posts_id',
        'is_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function Posts()
    {
        return $this->belongsTo(Post::class);
    }
}
