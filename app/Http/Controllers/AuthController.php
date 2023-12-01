<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class AuthController extends Controller
{
   public    function login()
   {
     //  dd(Hash::make("admin"));
        if (!empty(Auth::check()))
            {
                if(Auth::user()->user_type==1)
                {
                    return redirect('admin/dashboard');

                }else if(Auth::user()->user_type==2)
                {
                    return redirect('teacher/dashboard');

                }else if(Auth::user()->user_type==3)
                {
                    return redirect('student/dashboard');

                }else if(Auth::user()->user_type==4)
                {
                    return redirect('parent/dashboard');

                }
            }
            return view('auth.login');
   }
    public function AuthLogin(Request $request)
        {$remember =!empty($request->rember)?true:false;
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],$remember))
            {
                if(Auth::user()->user_type==1)
                {
                    return redirect('admin/dashboard');

                }else if(Auth::user()->user_type==2)
                {
                    return redirect('teacher/dashboard');

                }else if(Auth::user()->user_type==3)
                {
                    return redirect('student/dashboard');

                }else if(Auth::user()->user_type==4)
                {
                    return redirect('parent/dashboard');

                }
            }else
            {
                return redirect()->back()->with('error','please enter currect email and password');
            }

        }
        public function forgotpassword()
        {
            return view('auth.forgot');
        }
        public function postForgotPassword(Request $request)
        {
            $user =User::getEmailSingle($request->email);
            if(!empty($user))
            {
                $user->remember_token =Str::random(30);
                $user->save();
                Mail::to($user->email)->send(new ForgotPasswordMail($user));
                return redirect()->back()->with('success'," Please ckeck your Email and reset your password .");

            }
            else
            {
                return redirect()->back()->with('error',"Email not fount in the system .");
            }
        }

    public function logout ()
        {
            Auth::logout();
             return redirect(url(''));
        }
}
