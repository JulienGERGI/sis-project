<?php

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

trait UseZoom{
public $client;
public $jwt;
public $headers;

public function __construct(){
    $this->client = new Client();
    $this->accesstoken = "";

    $this->headers = [
        "Authorization"=> "Bearer " . $this->accesstoken,
        "Content-Type"=>"application/json",
        "Accept" => "application/json",
    ];
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

    if(isset($responseData["access-token"])){
        return $responseData["access-token"];
    }else{
        Log::error("Could not get the access token at the moment!");
    }
}


public function toZoomDateTime(string $dateTime){
    try{
        $date = new DateTime($dateTime);
        return $date->format("Y-m-d\TH:i:s");
    }catch(Exception $e){
        Log::error("Error converting to date time");
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
        "timezone"=>"Lebanon\Beirut"


    ]);

        return[
            "success"=>$response->getStatusCode() === 201,
            "data"=> json_decode($response->getBody(),true)
        ];

}
}
