<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Redirector;
use Illuminate\Http\RedirectResponse;


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
        {
            $remember =!empty($request->rember)?true:false;
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password],$remember))
            {
                if(Auth::user()->user_type==1)
                {
                    return redirect('admin/dashboard');

                }else if(Auth::user()->user_type==2)
                {
                    //return redirect('admin/dashboard');
                    return redirect('teacher/dashboard');

                }else if(Auth::user()->user_type==3)
                {
                    return redirect('student/dashboard');

                }else if(Auth::user()->user_type==4)
                {
                    return redirect('parent/dashboard');

                }else if(Auth::user()->user_type==5)
                {

                    return redirect('alumni/dashboard');

                }
            }
            else
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
        public function reset($remember_token)
        {
            $user =User::getTokenSingle($remember_token);
             if(!empty($user))
             {
                 $data['user']=$user;
               return view('auth.reset',$data)  ;
             }else
             {
                 abort(404);
             }
        }
        public function PostReset($token, Request $request)
        {
            if ($request->password==$request->cpassword)
            {
                $user =User::getTokenSingle($token);
                $user->password=Hash::make($request->password);
                $user->remember_token =Str::random(30);
                $user->save();
                return redirect(url(''))->with('success',"Password successfully reset");
            }
            else
            {
                return redirect()->back()->with('error', "Password and confirm password do not match");

            }
        }
    public function logout ()
        {
            Auth::logout();
             return redirect(url(''));
        }

        public function goToUpdateProfile(){
            $user = User::where("id",auth()->id())->get();
            return view("auth/updateProfile",["user"=>$user]);
        }
        public function updateProfile(Request $request){
            $user = User::where("id",auth()->id())->get();
            $user->name = $request->name;
            $user->save();
            dd($user);
            return redirect("alumni/dashboard")->with('success','Profile updated Successfully');
        }
}
