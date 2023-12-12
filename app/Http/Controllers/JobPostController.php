<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPost;

class JobPostController extends Controller
{
    public function goToCreateJob(Request $request){

        return view('alumni/CreateJob');
    }
    public function postJob(Request $request){
        // $request->validate(
        //     [
        //         'title'=>'required',
        //         'company'=>'required',
        //         'jobUrl'=>'required',
        //         'description'=>'required',
        //     ]
        // );

        $job = new JobPost();

        $job->title = $request->title;
        $job->company = $request->company;
        $job->jobUrl = $request->jobUrl;
        $job->description = $request->description;
        $job->userid = auth()->id();
        $job->save();

        return redirect("alumni/dashboard")->with("success","Job Posted Successfully");

    }
    public function DeleteJob(Request $request){

    }
    public function updateJob(Request $request){

    }
    public function getAllJobs(){

    }
    public function getJobs(Request $request){

    }
}
