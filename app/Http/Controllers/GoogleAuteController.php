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
                    'google_id'=>$google_user->getId()
                ]);
                AuthController::login($new_user);
                return $this->redirect()->intended('dashboard');
            }
            else{
                Auth::login($user);
                return $this->redirect()->intended('dashboard');
            }
        }catch (\Throwable $th){
            dd('sothing went wrong !');
        }
    }
}
