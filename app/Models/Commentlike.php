<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commentlike extends Model
{
    //

    protected $fillable = [
        'id', 'user_id', 'post_id','comment_id','owner_id',
     ];
 
    
     protected $hidden = [
        
     ];

     public function getcomment(){
        return $this->belongsTo(Comment::class,'comment_id','id');
      }



 
}
