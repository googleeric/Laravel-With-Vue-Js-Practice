<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function login(Request $request){
        $credential = $request->only('email','password');

        if(Auth::attempt($credential)){
           $token = Str::random(80);
           Auth::user()->api_token = $token;
           Auth::user()->save();
           return response()->json(['token' => $token], 200);
        }
        return response()->json(['status' => 'Email or Password is Wrong'], 403);
    }
    public function verify(Request $request)
    {
        return $request->user()->only('name','email');
    }
}
