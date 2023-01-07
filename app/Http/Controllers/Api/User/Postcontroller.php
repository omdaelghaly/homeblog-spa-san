<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Image;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Imagecomment;
use App\Models\Commentlike;
use App\Models\Repl;

use App\Http\Requests\Imagereq;


class Postcontroller extends Controller
{
    //

    public function savepost(Request $request)
    {
    	
        $newpost = Post::create([
                    'user_id' => auth('sanctum')->user()->id ,
                    'post' => $request->post ,
                    ]);  

           
            if($request->has('image'))
            {
                 $saveimag = $this->savepostimages($request,'/images/posts/images/',$newpost->id);
            }

            if($request->has('file'))
            {
                   $savefile = $this->savepostfiles($request,'/images/posts/files/',$newpost->id);
            }

        
                 $post = Post::with('getimages','getuser','getcomments','getlikes')
                                ->find($newpost->id);  
                   // foreach ($posts as $post) {
                   // $post->time = now()->diffForHumans();
                     // }
         
                 return response()->json([
                       'status'=>'success' ,
                       'msg' =>' You have posted successfully  ' ,
                       'data'=> $post ,
                            ]);        
                                                                                   
    }
//////////////
       public function like(Request $request)
       {
           $id = auth('sanctum')->user()->id ;
           $postid = $request->postid;
           $ownerid  = $request->ownerid;
           $like = Like::where(['user_id'=>$id, 'post_id'=>$postid])->first();
           if(!$like)
            { //like
               Like::create([
                'user_id'  => $id,
                'post_id'  => $postid, 
                'owner_id'  => $ownerid, 
               ]);

             $like = Like::where(['user_id'=>$id, 'post_id'=>$postid])->first();
                return response()->json([
                       'status'=>'success' ,
                       'msg' =>'like' ,
                       'data'=> $like ,
                            ]);       
            }else{//dislike
                     
                   $row = $like->id;      
                    $like->delete();  
 
                 return response()->json([
                       'status'=>'success' ,
                       'msg' =>'dislike' ,
                       'data'=> $row ,
                            ]);                          

            }

       }
       //////////////
       public function comlike(Request $request)
       {
           $id = auth('sanctum')->user()->id ;
           $postid = $request->postid;
           $ownerid  = $request->ownerid;
           $commentid  = $request->commentid;

           $like =Commentlike::where(['user_id'=>$id, 'post_id'=>$postid ,'comment_id'=>$commentid])->first();
           if(!$like)
            { //like
               Commentlike::create([
                'user_id'  => $id,
                'post_id'  => $postid, 
                'comment_id'  => $commentid, 
                'owner_id'  => $ownerid, 
               ]);

           $like =Commentlike::where(['user_id'=>$id, 'post_id'=>$postid ,'comment_id'=>$commentid])->first();
                return response()->json([
                       'status'=>'success' ,
                       'msg' =>'like' ,
                       'data'=> $like ,
                            ]);       
            }else{//dislike
                     
                   $rowid = $like->id;      
                    $like->delete();  
 
                 return response()->json([
                       'status'=>'success' ,
                       'msg' =>'dislike' ,
                       'data'=> $like ,
                            ]);                          

            }

       }
      // public function dislike(Request $request)
      //  {
      //      $id = auth('sanctum')->user()->id ;
      //      $postid = $request->postid;
      //      $ownerid  = $request->ownerid;
      //      $like = Like::where(['user_id'=>$id, 'post_id'=>$postid])->first();
      //      $row = $like->id;
      //      if($like)
      //       {
      //          $like->delete();  
      //       } 

      //  }

    public function savecomment(Request $request)
    {
               $postid = $request->postid ;  
               $comment = $request->comment ;  
             $newcomment = Comment::create([
                    'user_id' => auth('sanctum')->user()->id ,
                    'post_id' => $request->postid ,
                    'comment' => $request->comment ,
                    ]);  
          
            if($request->has('image'))
            {
                 $saveimag = $this->saveimages($request,'/images/posts/images/',$postid,$newcomment->id);
            }


             $new = Comment::with('getcommentimages','getcommentuser','getcommentlikes','getcommentreplys')
                       ->find($newcomment->id);  
                
            // $comment =  Comment::find($newcomment->id);   
                 return response()->json([
                       'status'=>'success' ,
                       'msg' =>' You have posted successfully  ' ,
                       'data'=> $new ,

                         ]);   

    }

    public function savereply(Request $request)
    {
               $postid = $request->postid ;  
               $commentid = $request->commentid ;  
               $reply = $request->reply ; 

             $newreply = Repl::create([
                    'user_id' => auth('sanctum')->user()->id ,
                    'post_id' => $request->postid ,
                    'comment_id' => $request->commentid ,
                    'reply' => $request->reply ,
                    ]);  
          
            if($request->has('image'))
            {
                 $saveimag = $this->saveimages($request,'/images/posts/images/',$postid,$newcomment->id);
            }


             $new = Repl::with('getreplyuser')->find($newreply->id);  
                
            // $comment =  Comment::find($newcomment->id);   
                 return response()->json([
                       'status'=>'success' ,
                       'msg' =>' You have replied successfully  ' ,
                       'data'=> $new ,

                         ]);   

    }


////delete post
    public function deletereply(Request $request)
    {
        $postid = $request->postid ;
        $commentid = $request->commentid ;
        $replyid = $request->replyid ;
        $reply =  Repl::with('getreplyuser')
                 ->find($replyid);
  
          if($reply){
                
                // $reply->delete();
          } 

        
                     return response()->json([
                       'status'=>'success' ,
                       'msg'=> " deleted successfully " ,
                        'data'=> '',
                                ]);  

    }

///////////////////edit aalll
         public function editall(Request $request)
         {
              $type = $request->type;
               
              if($type == 'post'){

                      $postid = $request->id;
                      $post = $request->text ;
                      $userid = $request->userid; //allready there or i may use my auth or make it fillable 

                      $postedit =  Post::with('getimages','getuser','getcomments','getlikes')->find($postid);
                    if($postedit->getimages()){
                    foreach ($postedit->getimages() as $image)
                    {     
                        if($image->name){  
                                  unlink('images/posts/images/'.$image->name);
                        }
                        if($image->file){  
                      
                                 unlink('images/posts/files/'.$image->file);
                         }
                      }
                      $postedit->getimages()->delete();
                    }    
                      $postedit->update([
                        'post' => $post,
                      ]);
        
            if($request->has('image'))
            {
                 $saveimag = $this->savepostimages($request,'/images/posts/images/',$postid);
            }

            if($request->has('file'))
            {
                   $savefile = $this->savepostfiles($request,'/images/posts/files/',$postid);
            }

                      $postedit =  Post::with('getimages','getuser','getcomments','getlikes')->find($postid);
 
                     return response()->json([
                       'status'=>'success' ,
                       'msg'=> " edit post successfully " ,
                       'type'=>'post',
                       'data'=> $postedit,
                                ]);  

/////////////////////comment edit//////////
               }elseif($type == 'comment'){


                      $commentid = $request->id;
                      $comment = $request->text ;
                      $userid = $request->userid;
                      $postid = $request->postid;
            $commentedit= Comment::with('getcommentimages','getcommentuser','getcommentlikes','getcommentreplys')
                       ->find($commentid);  

                    if($commentedit->getcommentimages()){
                    foreach ($commentedit->getcommentimages() as $image)
                    {     
                        if($image->name){  
                                  unlink('images/posts/images/'.$image->name);
                        }
                        if($image->file){  
                      
                                 unlink('images/posts/files/'.$image->file);
                         }
                      }
                      $commentedit->getcommentimages()->delete();
                    }    
                      $commentedit->update([
                        'comment' => $comment,
                      ]);
        
            if($request->has('image'))
            {
                 $saveimag = $this->saveimages($request,'/images/posts/images/',$postid,$commentid);
            }

            // if($request->has('file'))
            // {
            //        $savefile = $this->savepostfiles($request,'/images/posts/files/',$commentid);
            // }

            $commentedit= Comment::with('getcommentimages','getcommentuser','getcommentlikes','getcommentreplys')
                       ->find($commentid);  
 

                     return response()->json([
                       'status'=>'success' ,
                       'msg'=> " edit comment successfully " ,
                       'type'=>'comment',
                       'data'=> $commentedit,
                                ]);  
      

               }elseif($type == 'reply'){


                      $replyid = $request->id;
                      $reply = $request->text ;
                      $userid = $request->userid;
                      $postid = $request->postid;

            $replyedit= Repl::with('getreplyuser')->find($replyid);  

                 
                      $replyedit->update([
                        'reply' => $reply,
                      ]);
        

                     return response()->json([
                       'status'=>'success' ,
                       'msg'=> " edit reply successfully " ,
                       'type'=>'reply',
                       'data'=> $replyedit,
                                ]);  
      

               }
               //////



         }







          ///////function to save post image you can use it as a trait 
       protected function saveimages($req, $xpath,$postid,$commentid)// save comment images
    {

                        foreach($req->file('image')as $file)
                        {
                            $a=rand(0,100);
                            $path=public_path($xpath);
                            $ext= $file->getClientOriginalExtension();
                            $filename=$a.time().'.'.$ext ;
                            
                                if($ext=='png' || $ext=='jpg' || $ext=='jpeg')
                                        {
                                 $file->move($path,$filename);
           
                                        //save 
                                        Imagecomment::create([
                                        'user_id' => auth('sanctum')->user()->id ,
                                        'post_id' => $postid ,
                                        'comment_id' => $commentid ,
                                        'name'    => $filename ,
                                        ]);  
                                                                    
                                }else
                                {
                              return response()->json([
                                        'status'=>'error' ,
                                        'msg'=>' Image extension is not supported' ,
                                           ]);      
                           
                                } 


                  
                        }

                                // return response()->json([
                                //         'status'=>'success' ,
                                //         'msg'=>' You have posted successfully  ' ,
                                //              ]);        
                                                  
            

    }

    protected function savepostimages($req, $xpath,$postid)
    {

                        foreach($req->file('image')as $file)
                        {
                            $a=rand(0,100);
                            $path=public_path($xpath);
                            $ext= $file->getClientOriginalExtension();
                            $filename=$a.time().'.'.$ext ;
                            
                                if($ext=='png' || $ext=='jpg' || $ext=='jpeg')
                                        {
                                 $file->move($path,$filename);
           
                                        //save 
                                        Image::create([
                                        'user_id' => auth('sanctum')->user()->id ,
                                        'post_id' => $postid ,
                                        'name'    => $filename ,
                                        ]);  
                                                                  	
                                }else
                                {
                            	return response()->json([
                                        'status'=>'error' ,
                                        'msg'=>' Image extension is not supported' ,
            	                             ]);    	
                           
                                }	


                  
                        }

                                // return response()->json([
                                //         'status'=>'success' ,
                                //         'msg'=>' You have posted successfully  ' ,
                                //              ]);        
                                                  
            

    }


////////////////////
         ///////function to save post image you can use it as a trait 
    protected function savepostfiles($req, $xpath,$postid)
    {

                        foreach($req->file('file')as $file)
                        {
                            $a=rand(0,100);
                            $path=public_path($xpath);
                            $ext= $file->getClientOriginalExtension();
                            $filename=$a.time().'.'.$ext ;

                                if($ext=='xlsx' || $ext=='xls' || $ext=='doc'
                                     || $ext=='docx' || $ext=='ppt' || $ext=='pptx'
                                       || $ext=='txt' || $ext=='pdf' )
                                        {
                                        $file->move($path,$filename);
           
                                        //save 
                                        Image::create([
                                        'user_id' => auth('sanctum')->user()->id ,
                                        'post_id' => $postid ,
                                        'file'    => $filename ,
                                        ]);  
                                                                    
                                }else
                                {
                                return response()->json([
                                        'status'=>'error' ,
                                        'msg'=>' File extension is not supported' ,
                                             ]);        
                           
                                }   


                  
                        }
                                  // return response()->json([
                                  //       'status'=>'success' ,
                                  //       'msg'=>' You have posted successfully  ' ,
                                  //            ]);        
                                                                        
            

    }







}
