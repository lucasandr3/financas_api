<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class ApiServiceHotmart
{
    private $token;

    public function Auth()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.$_ENV['HT_BASIC'].""
        ])->post('https://api-sec-vlc.hotmart.com/security/oauth/token?grant_type=client_credentials&client_id='.$_ENV['HT_CLIENTID'].'&client_secret='.$_ENV['HT_CLIENTSECRET'].'');

        setcookie('hotmart', $response->body());
        $this->token = json_decode($response->body());
    }

    public function getToken()
    {
        if(!isset($_COOKIE['hotmart'])) {
            $this->Auth();
            return $this->token;
        }

        return $this->token = json_decode($_COOKIE['hotmart']);
    }

    public function get($endpoint)
    {
        $token = $this->getToken()->access_token;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' .$token. ""
        ])->get(Constants::API_SANDBOX.$endpoint);

        if($response->status() === 404) {
            return (Object)['message' => 'Serviço Hotmart em Manutenção e/ou fora do ar', 'code' => 404];
        }

        return $response->body();
    }

    public function post($endpoint, $body = null)
    {
        $token = $this->getToken()->access_token;

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' .$token. ""
        ])->withBody(json_encode(['send_mail' => false]), 'raw')->post(Constants::API_SANDBOX.$endpoint);

        if($response->status() === 404) {
            return (Object)['message' => 'Serviço Hotmart em Manutenção e/ou fora do ar', 'code' => 404];
        }

        return $response->body();
    }
}
