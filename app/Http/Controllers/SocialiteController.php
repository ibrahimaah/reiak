<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SocialiteService;
use Exception;
use Laravel\Socialite\Facades\Socialite;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
   
    protected $socialiteService;

    public function __construct(SocialiteService $socialiteService)
    {
        $this->socialiteService = $socialiteService;
    }
    
    public function redirectToProvider($provider)
    {
        return $this->socialiteService->redirectToProvider($provider);
    }

    public function handleProviderCallback($provider)
    {
       return $this->socialiteService->handleProviderCallback($provider);
    }

   

    public function handleTwitterCallback()
    {
        
        try
        {
            
            $user_twitter = Socialite::driver('twitter')->user();
            
            $user_exists = User::where('twitter_id',$user_twitter->id)->where('email',$user_twitter->email)->first();
        
            
            if(!$user_exists)
            {
                $user = new User();
                $user->twitter_id = $user_twitter->id;
                $user->email = $user_twitter->email;
                $user->name = $user_twitter->name;
                $user->role = 'user';
                $user->save();
                auth()->login($user);
            }
            else
            { 
                auth()->login($user_exists);
            }
            
            return redirect()->route('platform.index');
        
        }
        catch(Exception $e)
        {
            dd($e->getMessage());
        }
    }
    
}
