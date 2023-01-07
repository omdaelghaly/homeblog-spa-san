<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
       //
       protected $fillable = [
        'id', 'user_id', 'post_id', 'name','file'
     ];
 
    
     protected $hidden = [
        
     ];
 
           
     public function getpost(){
       return $this->belongsTo(Post::class, 'post_id','id');
     }
}
