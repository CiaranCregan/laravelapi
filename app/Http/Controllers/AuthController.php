<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class AuthController extends Controller
{
    public function login (Request $request)
    {
        $client = new Client(["base_uri" => "http://localhost:8888"]);
        $options = [
            "form_params" => [
                "username" => $request->username, 
                 "password" => $request->password,
                 "client_id" => 2,
                 "client_secret" => "yS1reMBhWQKR6Bnv6XfzadznIWQjgTkXzQ2NKrxB",
                 "grant_type" => "password",
            ]
        ]; 
        $response = $client->post("/example-project/public/oauth/token", $options);

        return $response->getBody();
    }
}
