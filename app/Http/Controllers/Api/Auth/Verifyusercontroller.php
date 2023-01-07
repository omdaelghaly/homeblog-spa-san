<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\Verifyemail;
use App\Models\User;
use App\Models\Verifyuser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class Verifyusercontroller extends Controller
{

    public function __construct() {
        $this->middleware('auth:sanctum');
    }


    // //
    public function sendverifyemail(Request $request)
    {
      
        //set token
        $code = rand(10000,1000000);
        $token = md5($code);
        
        //set time expire
        $timeex = 60 * 60;
        $time=date("Y-m-d H:i:s",$timeex);
        $limittime= strtotime($time);
         //time now 
        $timenow =  date("Y-m-d H:i:s");
        $now= strtotime($timenow);
         //time now + expire time
        $expire  = $now + $limittime;
  
        $id = auth('sanctum')->user()->id;
        $verifyuser = auth('sanctum')->user()->verifyemail ;
        
        $user = User::where('id',$id)->with('getverifyuser')->first();
         //check if verifyeied user
        if($verifyuser == 0) 
        {
                  //if there is a user record in verifyuser
                  if($user->getverifyuser )
                   {
                                //check expire < now if u dont want to send many times
                           // updateif exist 
                            $user->getverifyuser->update([
                                            'user_id' => $id,
                                            'token'   => $token,
                                            'expire'  => $expire
                                            ]);

                      $user = User::where('id',$id)->with('getverifyuser')->first();
                           Mail::to($user->email)->send(new Verifyemail($user));
                          return response()->json(['status'=> 'success','data'=> __('myauth.sendok')]);
   
                   }else //create
                    {
                              Verifyuser::create([
                                'user_id' => $id,
                                'code'    => '0' ,
                                'token'   => $token,
                                'expire'  => $expire,
                              ]);
                              
                       $user = User::where('id',$id)->with('getverifyuser')->first();
                         Mail::to($user->email)->send(new Verifyemail($user));
                           return response()->json(['status'=> 'success','data'=>  __('myauth.sendok')]);

                              
                   }
        }else //so user is verifyed
        {
           if($user->getverifyuser){
           $user->getverifyuser->delete();
           }
        return response()->json(['status'=> 'auth','data'=> 'ur auth']);
        }

          
     
          
    }





//////////////////////callback/////////////////

     public function callback_ve(Request $request)
     {
                    //time now 
            $timenow =  date("Y-m-d H:i:s");
            $now     = strtotime($timenow);

            $id = auth('sanctum')->user()->id ;
            $user = User::where('id',$id)->with('getverifyuser')->first();

            $verifyuser = $user->verifyemail ;
            $emailDB    = $user->email ;
            $email      = $request->emailx;
            $token      = $request->tokenx;
              
            if($verifyuser == 0)//if verified
            {
                if($user->getverifyuser)
                {
                    $expire     = $user->getverifyuser->expire ;
                    $tokenDB    = $user->getverifyuser->token ;


                    //checkexpire
                    if($now < $expire )// the token is ok
                    {
                               if($emailDB == $email && $tokenDB == $token  )
                               {//link is ok 
                                // $id   = auth('sanctum')->user()->id;
                                // $user = User::find($id);
                                $user->verifyemail = 1;
                                $user->save();
                                //delete user row token verify
                                $row  = $user->getverifyuser ;
                                $row->delete();
              
                                   return response()->json([
                                               'status'=>'success' ,
                                               'msg' => __('myauth.verifyeok') 
                                                       ]);


                              }else
                               { // هناك خطا فى الرابط 
                                  return response()->json([
                                               'status'=>'error' ,
                                                'msg' =>  __('myauth.linkwrong')
                                                       ]);

                               }
                         
                    }else //token is expired
                    { //اتهت صلاحية الرابط
                                   return response()->json([
                                               'status'=>'error' ,
                                                'msg' =>  __('myauth.tokenexpired')
                                                       ]);

                    }
                }else
                {
                                  return response()->json([
                                               'status'=>'error' ,
                                                 'msg' =>  __('myauth.linkwrong')
                                              
                                                       ]);
                }    

            }else//so you are verifyed
            {
                                  return response()->json([
                                               'status'=>'success' ,
                                               'msg' => __('myauth.verifyedbefore') 
                                                       ]);
          }




     }



    
}
