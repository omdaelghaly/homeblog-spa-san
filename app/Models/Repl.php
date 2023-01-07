<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Repl extends Model
{
    //

    protected $fillable = [
        'id', 'user_id', 'post_id', 'comment_id','reply'
     ];
 
    
     protected $hidden = [
        
     ];
 
    public function getCreatedAtAttribute($date)
    {
            return \Carbon\Carbon::parse($date)->diffForHumans();
    }


     public function getreplycomment(){
        return $this->belongsTo(Comment::class,'comment_id','id');
      }
     public function getreplypost(){
        return $this->belongsTo(Post::class,'post_id','id');
      }
      public function getreplyimages(){
        return $this->hasMany(Imagereply::class,'reply_id','id');
      }


     public function getreplyuser(){
        return $this->belongsTo(User::class,'user_id','id');
      }

  


}
