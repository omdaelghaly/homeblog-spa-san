<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Imagereq extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // // 'file' => 'mimes:jpg,png,jpeg|max:51' ,
             'image' => 'image|mimes:jpeg,jpg,png,gif|max:100000',
        ];
    }


    // public function messages(){
    //     return [
        
    //      'email.required'=>trans('myauth.email.required'),
    //      'email.email'=>trans('myauth.email.email'),
    //      'email.max'=>trans('myauth.email.max'),
    //      'password.required'=>trans('myauth.password.required'),
    //      'password.min'=>trans('myauth.password.min'),
    //      'password.max'=>trans('myauth.password.max'),
    //     ];

    // }   

}
