<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
// use Carbon\Carbon;
class Post extends Model
{
    //

     protected $fillable = [
       'id', 'user_id', 'post','created_at'
    ];

   
    protected $hidden = [
       
    ];



    public function getCreatedAtAttribute($date)
    {
            return \Carbon\Carbon::parse($date)->diffForHumans();
    }


     
    public function getuser(){
      return $this->belongsTo(User::class, 'user_id','id');
    }

    public function getimages(){
      return $this->hasMany(Image::class, 'post_id','id');
    }

    public function getlikes(){
      return $this->hasMany(Like::class,'post_id','id');
    }
    public function getcomments(){
      return $this->hasMany(Comment::class, 'post_id','id');
    }
  
  





}
