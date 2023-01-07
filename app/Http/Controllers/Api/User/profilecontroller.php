<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class profilecontroller extends Controller
{
    //

       public function updatemyinfo(Request $request){
     	         $id = auth('sanctum')->user()->id;
                 $name  = $request->name; 
                 $password  = $request->password; 
                 $email  = $request->email; 
                 $job    = $request->job; 
                 $about  = $request->about; 
                 $token  = $request->token; 
                  
            
            $user = User::find($id);

            if($request->has('image'))
            {
            	if($user->image != 'default.jpg'){
                    unlink('images/profiles/'.$user->image);		
                    $imagename = $this->saveprofileimages($request,'/images/profiles/',$id);
                                $user->update([
                                  'name'   => $name,
                                  'job'    => $job,
                                  'about'  => $about,
                                  'image'=> $imagename,
                                   ]);

            	}else{

                    $imagename = $this->saveprofileimages($request,'/images/profiles/',$id);
                                $user->update([
                                  'name'   => $name,
                                  'job'    => $job,
                                  'about'  => $about,
                                  'image'=> $imagename,
                                   ]);

            	}

            }else{

             $user->update([
                'name'   => $name,
                'job'    => $job,
                'about'  => $about,
             ]);

            }          


       $user->token = $token;
       return response()->json([
                       'status'=>'success' ,
                       'msg' =>'updated successfully' ,
                       'data'=> $user ,
                       
                            ]);                          

     }
////////////

   protected function saveprofileimages($req, $xpath,$postid)
    {

                        $file = $req->image;
                       
                            $a=rand(0,100);
                            $path=public_path($xpath);
                            $ext= $file->getClientOriginalExtension();
                            $filename=$a.time().'.'.$ext ;
                            
                                if($ext=='png' || $ext=='jpg' || $ext=='jpeg')
                                        {
                                 $file->move($path,$filename);
           
                                        //save 
                                    return $filename;
                                                                  	
                                }else
                                {
                            	return response()->json([
                                        'status'=>'error' ,
                                        'msg'=>' Image extension is not supported' ,
            	                             ]);    	
                           
                                }	


               

                 
    }


     





///////
}
