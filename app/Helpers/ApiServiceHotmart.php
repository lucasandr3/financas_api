<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ApiServiceHotmart
{
    public function Auth()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.$_ENV['HT_BASIC'].""
        ])->post('https://api-sec-vlc.hotmart.com/security/oauth/token?grant_type=client_credentials&client_id='.$_ENV['HT_CLIENTID'].'&client_secret='.$_ENV['HT_CLIENTSECRET'].'');

        setcookie('hotmart', $response->body());
    }

    public function getToken()
    {
        return json_decode($_COOKIE['hotmart']);
    }

    public function get($endpoint)
    {
        $token = $this->getToken()->access_token;

        if($token) {

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$token.""
            ])->get(Constants::API_SANDBOX.$endpoint);

            return $response->body();

        } else {

            $this->Auth();
            $token = $this->getToken()->access_token;

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic '.$token.""
            ])->get(Constants::API_SANDBOX.$endpoint);

            return $response->body();
        }

    }
}
