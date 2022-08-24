@extends('layouts.app')

@section('title', 'Login')

@section('sidebar')
    @parent

    <p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<div class=" bg-gray-300">
    <div class="container h-screen flex justify-center items-center">

       <div class="p-8 bg-white rounded-lg max-w-6xl pb-10">

           <div class="flex justify-center mb-4">

            <img src="https://i.imgur.com/f6Tb5U1.png" width="70">

           </div>

          <input type="text" class="h-12 rounded w-full border px-3 focus:text-black focus:border-blue-100" placeholder="Email">

          <input type="text" class="h-12 mt-3 rounded w-full border px-3 focus:text-black focus:border-blue-100" placeholder="Password">


          <div class="flex justify-end items-center mt-2">

            <a href="#" class="text-gray-400 hover:text-gray-600" >Forgot password?</a>

          </div>

          <button class="uppercase h-12 mt-3 text-white w-full rounded bg-red-700 hover:bg-red-800">login</button>


          <div class="flex justify-between items-center mt-3">

            <hr class="w-full">
            <span class="p-2 text-gray-400 mb-1">OR</span>
            <hr class="w-full">

          </div>


          <a role="button" href="{{url('/login/google')}}" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full"><i class="fa fa-facebook mr-2"></i>Masuk dengan Google</a>


       </div>

    </div>
  </div>
@endsection
