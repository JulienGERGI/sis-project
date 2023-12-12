<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webinar;
use App\Models\JobPost;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function dashboard()
    {

        $data['header_title']='Dashboard';
        if(Auth::user()->user_type==1)
        {
            return view('admin.dashboard',$data);

        }else
            if(Auth::user()->user_type==2)
        {
           return view('admin.dashboard',$data);
           // return view('teacher.dashboard',$data);

        }else
            if(Auth::user()->user_type==3)
        {
            return view('student.dashboard',$data);

        }else
            if(Auth::user()->user_type==4)
        {
            return view('parent.dashboard',$data);

        }else
            if(Auth::user()->user_type==5)
        {
            $webinars = Webinar::where('userid',auth()->id())->get();
            $jobs = JobPost::where('userId',auth()->id())->get();
            return view('alumni/dashboard', ['webinars' => $webinars], ['jobs' => $jobs]);

        }

    }
}
