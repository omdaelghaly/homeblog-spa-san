

@component('mail::message')
<h2>Dear, {{$user->name}}</h2>
<p>{{__('myauth.mailthanks')}}</p>
<p>{{__('myauth.emailv')}}</p>



 @component('mail::button',['url'=> config('app.url') ."/callback_ve/e/" .$user->email ."/t/" .$user->getverifyuser->token ])
<h3>{{__('myauth.emailv')}} </h3>

@endcomponent
 




  
@endcomponent
