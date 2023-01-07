<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagecomment extends Model
{
    //

    protected $fillable = [
        'id', 'user_id', 'post_id', 'comment_id' , 'name'
     ];
 
    
     protected $hidden = [
        
     ];
 





    public function getcomment(){
        return $this->belongsTo(Comment::class, 'comment_id','id');
      }



}
