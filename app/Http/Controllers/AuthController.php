<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

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

    public function register (Request $request){

        $validation = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);

        if ($validation->fails()) {
            return response()->json($validation->messages()->first(), 405);
        } else {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'isAdmin' => 0
            ]);

            return response()->json(null, 201);
        }
    }

    public function loggout() {
        Auth()->user()->tokens->each(function ($token, $key){
            $token->delete();
        });

        return response()->json('Successfully logged out', 200);
    }
}
