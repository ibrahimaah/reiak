<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        try{
            $user = Socialite::driver('google')->user();
            $finduser = User::where('social_id',$user->id)->first();
            if($finduser){
                Auth::login($finduser);
                return redirect()->route('platform.index');
            }else{
                $newUser = User::create([
                    'name'=>$user->name,
                    'role'=>'user',
                    'email'=>$user->email,
                    'social_id'=>$user->id,
                    'social_type'=>'google',
                    'password'=>Hash::make('my-google'),
                ]);
                Auth::login($newUser);
                return redirect()->route('platform.index');
            }
        }catch(Exception $e){
            dd($e->getMessage());
        }
    }
}
