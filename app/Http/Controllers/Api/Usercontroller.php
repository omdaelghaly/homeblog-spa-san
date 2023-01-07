<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Traits\GeneralResponse;


class Usercontroller extends Controller
{
    //
    use GeneralResponse;
    
    public function getusers()
    {
    	$users = User::first();
            $rules = [
                "email" => "required",
                "password" => "required"

            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                $code = $this->returnCodeAccordingToInput($validator);
                return $this->returnValidationError($code, $validator);
            }
           return $this->returnError('500',$users);

           //  $this->returnSuccessMessage($msg = "hhhhhhhhh", $errNum = "S000");

     //         return response()->json([
     //     'users'=>$users
     // ]);


    }

}
