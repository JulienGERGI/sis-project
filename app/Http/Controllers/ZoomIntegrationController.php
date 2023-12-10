<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\UseZoom;
use App\Models\Appointment;
use App\Models\Webinar;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Facades\Zoom;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class ZoomIntegrationController extends Controller
{
    use UseZoom;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;


    public function createZoomLink($request)
    {

        $data = $this->create($request);

        return $data;
    }



    public function createMeeting(Request $request)
    {
        request()->validate(
            [
                'topic'=>'required',
                'startTime'=>'required',
                'duration'=>'required',
                'agenda'=>'required',
            ]
        );
     $data = $this->createZoomLink($request);
     if($data["success"]){

            $webinar=new Webinar();
            $webinar->topic=trim($request->topic);
            $webinar->startTime=trim($request->startTime);
            $webinar->duration=$request->duration;
            $webinar->password=trim($request->password);
            $webinar->agenda=trim($request->agenda);
            $webinar->save();


        return redirect()->route('alumni/dashboard', compact('data'))->with('success','Meeting created successfully');
     }

    return redirect()->route('alumni/dashboard')->with('error','Could not create meeting at the moment');
    }




    /**
     * Zoom Meeting
     *
     * @return \Illuminate\Http\Response
     */
    public function meeting(Request $req)
    {

        return view('zoom.meeting', get_defined_vars());
    }

     /**
     * Zoom ended
     *
     * @return \Illuminate\Http\Response
     */
    public function ended(Request $req)
    {
        return view('zoom.class-end');
    }

}
