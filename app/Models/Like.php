<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    //

    protected $fillable = [
        'id', 'user_id', 'post_id', 'owner_id'
     ];
 
    
     protected $hidden = [
        
     ];

     public function getpost(){
        return $this->belongsTo(Post::class,'post_id','id');
      }



 
}
