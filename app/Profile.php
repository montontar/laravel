<?php

namespace App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;
class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'username',
        'email',
        'images',
        'path'
    ];

    public function getprofile(){
        return Storage::url($this->path);
    }

}
