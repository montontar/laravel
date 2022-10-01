<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Follow extends Model
{
    protected $fillable = [
        'user_id',
        'user_id_follow',
        'follower',
        'is_status',
    ];

    public function user(){
        return $this->belongsTo( User::class );
    }
}
