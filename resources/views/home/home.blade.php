
@extends('layout.app')



@section('pagecontent')
    
    
		<div id="app">
      <div class="col-12 p-0 m-0">
          <mynavbar class="col-12 p-0 m-0" mysite="{{config('app.name')}}" :lang="{{ json_encode(trans('myauth')) }}"></mynavbar>

             <router-view :lang="{{ json_encode(trans('myauth')) }}"></router-view>
      </div>
		
		</div>
	
@endsection

@section('style')

<style >
/* width */
::-webkit-scrollbar {
  width: 5px;

}



/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555;
}

    ::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px green;
  border-radius: 10px;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: blue;
  border-radius: 10px;

   
</style>

@endsection
