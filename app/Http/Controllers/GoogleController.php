<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function login()
    {
        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {
        try {
            $google_user = Socialite::driver('google')->user();
            $user = User::where('email',$google_user->getEmail())->first();
            if($user){
                Auth::login($user);
                return redirect('users');
            } else {
                $new_user = User::create([
                    'name'=>ucwords($google_user->getName()),
                    'email'=>$google_user->getEmail(),
                    'password'=>Hash::make(Str::random(10)),
                    'email_verified_at'=>now(),
                    'remember_token'=>Str::random(10)
                ]);
                return redirect('users');
            }
        } catch (\Throwable $th) {
            abort(404,$th->getMessage());
        }
    }


}
