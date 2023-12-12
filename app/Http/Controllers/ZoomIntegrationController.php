<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\UseZoom;
use App\Models\Appointment;
use App\Models\Webinar;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Facades\Zoom;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;

class ZoomIntegrationController extends Controller
{
// use UseZoom;

const MEETING_TYPE_INSTANT = 1;
const MEETING_TYPE_SCHEDULE = 2;
const MEETING_TYPE_RECURRING = 3;
const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;
public $client;
public $jwt;
public $headers;
public $accesstoken;

public function __construct(){
$this->client = new Client();
$this->accesstoken = "";

$this->headers = [
"Authorization"=> "Bearer " . $this->accesstoken,
"Content-Type"=>"application/json",
"Accept" => "application/json",
];
}


public function createZoomLink($request)
{

$data = $this->create($request);

return $data;
}

public function goToCreate(){
return view('alumni/createWebinar');
}

public function generateZoomAccessToken(){
$apiKey = env("ZOOM_API_CLIENT_ID");
$apiSecret = env("ZOOM_API_CLIENT_SECRET");
$url = env("ZOOM_API_URL");
$accountId = env("ZOOM_API_ACCOUNT_ID");

$base64Credentials = base64_encode($apiKey.":".$apiSecret);

$url = "https://zoom.us/oauth/token?grant_type=account_credentials&account_id=" . $accountId;

$response = Http::withHeaders(
[
"Authorization"=>"Basic " . $base64Credentials,
"Content-type"=> "application/x-www-form-urlencoded"
]
)->post($url);

$responseData = $response->json();
if(isset($responseData["access_token"])){
return $responseData["access_token"];
}else{
Log::error("Could not get the access token at the moment!");
}
}

public function create(Request $request){
$accessToken = $this->generateZoomAccessToken();

$url = env("ZOOM_API_URL") . "users/me/meetings";

$response = Http::withToken($accessToken)->post($url, [
"topic"=>$request->topic,
"type"=>2,
"startTime"=>$request->startTime,
"duration"=>$request->duration,//integer
"agenda"=>$request->agenda,
"password"=>$request->password,
"timezone"=>"Lebanon\Beirut",
"userid"=>auth()->id()


]);

return[
"success"=>$response->getStatusCode() === 201,
"data"=> json_decode($response->getBody(),true)
];

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
$webinar->userid=auth()->id();
$webinar->joinLink=trim($data["data"]["join_url"]);
$webinar->startLink=trim($data["data"]["start_url"]);
$webinar->save();
// $webinars = Webinar::where('userid',auth()->id())->get();
return redirect('alumni/dashboard')->with('success','Meeting created successfully');
}
// $webinars = Webinar::where('userid',auth()->id())->get();
return redirect('alumni/dashboard')->with('success','Meeting created successfully');
}


public function getWebinarsOfCurrentAlumni(){
$webinars = Webinar::where('userid',auth()->id())->get();
return view('alumni/dashboard', ['webinars' => $webinars]);
}




}
