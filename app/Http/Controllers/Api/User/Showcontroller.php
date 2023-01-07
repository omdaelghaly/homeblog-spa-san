<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Image;

use App\Http\Requests\Imagereq;

class Showcontroller extends Controller
{
    //


    public function getposts()
    {
    	
     $posts = Post::with(['getimages','getuser' ,'getlikes','getcomments'=>function($q){
         $q->with(['getcommentuser','getcommentimages','getcommentlikes','getcommentreplys'=>function($qq){
          $qq->with(['getreplyuser'])
              ->orderBy('created_at', 'desc');

         }])
            ->orderBy('created_at', 'desc');
           }])
           ->orderBy('created_at', 'desc')
           ->get();  

     // foreach ($posts as $post) {
     //     $post->time = $post->created_at->diffForHumans();

     //      foreach ($post->getcomments as $comment) {
     //       $comment->time = $comment->created_at->diffForHumans();
     //      }

     //  }
       // $posts[0]->timexx = $posts[0]->created_at->diffForHumans();
                     return response()->json([
                       'status'=>'success' ,
                       'data'=> $posts  ,
                       
                            ]);                                                                     
                                  
    }

////delete post
    public function deletepost(Request $request)
    {
        $postid = $request->id ;
        $post =  Post::with('getimages','getuser','getcomments','getlikes')
                 ->find($postid);
  
          if($post){
                if($post->getimages){
                    foreach ($post->getimages as $image)
                    {     
                        if($image->name){  
                              //    $ex = $image->name->getClientOriginalExtension();
                              //    $allow = array('png','jpg','jpeg');
                              //    $allow2 =array('xlsx' ,'xls' ,'doc','docx' ,'ppt' ,'pptx','txt' ,'pdf');
                              // if(in_array($ex,$allow)){
                                 unlink('images/posts/images/'.$image->name);
  
                       }
                        if($image->file){  
                              //    $ex = $image->file->getClientOriginalExtension();
                              //    $allow = array('png','jpg','jpeg');
                              //    $allow2 =array('xlsx' ,'xls' ,'doc','docx' ,'ppt' ,'pptx','txt' ,'pdf');
                              // if(in_array($ex,$allow)){
                              //    unlink('images/posts/images/'.$image->name);
                              // }elseif (in_array($ex,$allow2)) {
                                 unlink('images/posts/files/'.$image->file);
                             // }
                      }

                    }
                    $post->getimages()->delete();
                }
                if($post->getcomments)
                  {       
                    $post->getcomments()->delete();
                  }

                  if($post->getlikes)
                  {       
                    $post->getlikes()->delete();
                  }
                       
                $post->delete();
          } 

          // $posts = Post::with('getimages','getuser','getcomments')
          //                       ->orderBy('created_at', 'desc')
          //                       ->get();  

          //          foreach ($posts as $post) {
          //          $post->time = $post->created_at->diffForHumans();
          //            }
                     
                     return response()->json([
                       'status'=>'success' ,
                       'msg'=> " deleted successfully " ,
                        'data'=> '',
                                ]);  

    }


    public function deletecomment(Request $request)
    {
        $postid = $request->postid ;
        $commentid = $request->commentid ;
        $comment =  Comment::with('getcommentimages','getcommentuser','getcommentlikes')
                    ->find($commentid);
  
          if($comment){
                if($comment->getcommentimages()){
                    foreach ($comment->getcommentimages() as $image) {
                      unlink('images/posts/images/'.$image->name);
                    }
                    $comment->getcommentimages()->delete();
                } 

                 if($comment->getcommentlikes()){
                    $comment->getcommentlikes()->delete();
                  }
                    if($comment->getcommentreplys()){
                    $comment->getcommentreplys()->delete();
                  }
                    $comment->delete();
          } 

          // $comment = Comment::with('getcommentimages','getcommentuser','getcommentimages')
          //                       ->orderBy('created_at', 'desc')
          //                       ->get();  

                     
                     return response()->json([
                       'status'=>'success' ,
                       'msg'=> " deleted successfully " ,
                        'data'=> $comment,
                                ]);  

    }
////////////////
 


 public function deletetry(Request $request)
    {


                     return response()->json([
                       'status'=>'success' ,
                       'msg'=> " deleted successfully " ,
                       'data'=> '',
                                ]);  
}



}
