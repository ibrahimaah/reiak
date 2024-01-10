<?php 

namespace App\Services;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Exception;

class SocialiteService
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try
        {
            $userSocial = Socialite::driver($provider)->user();
            $user = User::where($provider . '_id', $userSocial->id)->where('email', $userSocial->email)->first();

            if (!$user) 
            {
                $user = new User();
                $user->{$provider . '_id'} = $userSocial->id;
                $user->email = $userSocial->email;
                $user->name = $userSocial->name;
                $user->role = 'user';
                $user->save();
            }

            auth()->login($user);

            return redirect()->route('platform.index');;
            
        }
        catch(Exception $ex)
        {
            dd($ex->getMessage());
        }
        
    }
    // public function handleTwitterCallback()
    // {
        
    //     try
    //     {
            
    //         $user_twitter = Socialite::driver('twitter')->user();
            
    //         $user_exists = User::where('twitter_id',$user_twitter->id)->where('email',$user_twitter->email)->first();
        
            
    //         if(!$user_exists)
    //         {
    //             $user = new User();
    //             $user->twitter_id = $user_twitter->id;
    //             $user->email = $user_twitter->email;
    //             $user->name = $user_twitter->name;
    //             $user->role = 'user';
    //             $user->save();
    //             auth()->login($user);
    //         }
    //         else
    //         { 
    //             auth()->login($user_exists);
    //         }
            
    //         return redirect()->route('platform.index');
        
    //     }
    //     catch(Exception $e)
    //     {
    //         dd($e->getMessage());
    //     }
    // }
}