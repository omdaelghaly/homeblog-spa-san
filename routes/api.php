<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register','Api\Auth\Registercontroller@register')->name('register');
Route::post('/RTregister','Api\Auth\Registercontroller@RTregister')->name('RTregister');

Route::post('/login','Api\Auth\Logincontroller@login')->name('login');
Route::post('/RTlogin','Api\Auth\Logincontroller@RTlogin')->name('RTlogin');
//password verify
Route::post('/pwdsendemail', 'Api\Auth\Forgetpwdcontroller@pwdsendemail');
Route::post('callback_pwd_check', 'Api\Auth\Forgetpwdcontroller@callback_pwd_check')->name('callback_pwd_check');
Route::post('savenewpwd', 'Api\Auth\Forgetpwdcontroller@savenewpwd')->name('savenewpwd');
//home getposts
Route::get('/getposts','Api\User\Showcontroller@getposts')->name('getposts');

Route::group(['middleware'=>'auth:sanctum'], function(){

    Route::get('logout', 'Api\Auth\Logincontroller@logout');
    Route::post('/autologin', 'Api\Auth\Logincontroller@autologin');
    Route::post('refresh', 'Api\Auth\Logincontroller@refresh');
    Route::post('me', 'Api\Auth\Logincontroller@me');
    Route::post('sendverifyemail', 'Api\Auth\Verifyusercontroller@sendverifyemail');
    Route::post('callback_ve', 'Api\Auth\Verifyusercontroller@callback_ve')->name('callback_ve');

    Route::post('/savepost', 'Api\User\Postcontroller@savepost');
    Route::post('/savecomment', 'Api\User\Postcontroller@savecomment');
    Route::post('/deletepost', 'Api\User\Showcontroller@deletepost');
    Route::post('/deletecomment', 'Api\User\Showcontroller@deletecomment');
    Route::post('/like', 'Api\User\Postcontroller@like');
    Route::post('/comlike', 'Api\User\Postcontroller@comlike');
    Route::post('/savereply', 'Api\User\Postcontroller@savereply');
    Route::post('/deletereply', 'Api\User\Postcontroller@deletereply');
    Route::post('/editall', 'Api\User\Postcontroller@editall');
    //profile
    Route::post('/updatemyinfo', 'Api\User\Profilecontroller@updatemyinfo');


    // Route::post('/dislike', 'Api\User\Postcontroller@dislike');

    Route::post('/deletetry', 'Api\User\Showcontroller@deletetry');
    
});

 // Route::get('callback_ve/e/{email}/t/{token}', 'Api\Auth\verifyusercontroller@callback_ve');
