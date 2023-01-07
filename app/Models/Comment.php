<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    protected $fillable = [
        'id', 'user_id', 'post_id', 'comment'
     ];
 
    
     protected $hidden = [
        
     ];
 

    public function getCreatedAtAttribute($date)
    {
            return \Carbon\Carbon::parse($date)->diffForHumans();
    }

     public function getcommentpost(){
        return $this->belongsTo(Post::class,'post_id','id');
      }

      public function getcommentimages(){
        return $this->hasMany(Imagecomment::class,'comment_id','id');
      }


      // public function getcomments(){
      //   return $this->belongsTo(User::class,'comment_id','id');
      // }

     public function getcommentuser(){
        return $this->belongsTo(User::class,'user_id','id');
      }

  
      public function getcommentlikes(){
        return $this->hasMany(Commentlike::class,'comment_id','id');
      }

      public function getcommentreplys(){
        return $this->hasMany(Repl::class,'comment_id','id');
      }


}

