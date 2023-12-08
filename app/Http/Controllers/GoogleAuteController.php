<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
class GoogleAuteController extends Controller
{
    public  function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function callbackGoogle(){
        try {
            $google_user=Socialite::driver('google')->user();
            $user=User::where('google_id',$google_user->getId())->first();
            if (!$user){

                $new_user=User::create([
                    'name'=>$google_user->getName(),
                    'email'=>$google_user->getEmail(),
                    'google_id'=>$google_user->getId(),
                    'accessToken' => $google_user->token, // Access Token
                    'refreshToken' => $google_user->refreshToken, // Refresh Token (if available)
                ]);
                echo "Hello, World!";
                $new_user->markEmailAsVerified();
                Auth::login($new_user);
                return redirect()->route('login');
            }
            else{
                Auth::login($user);
                return redirect()->route('login');
            }
        }catch (\Throwable $th){
            \Log::error('Error creating user: ' . $th->getMessage());
            dd('sothing went wrong !');
        }
    }
}
