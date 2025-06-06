<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name'=>"required|max:255",
            'email'=>"required|email|unique:users",
            'password'=>"required|confirmed"
        ]);

        $user = User::create($fields);

        $token = $user->createToken($request->name);

        return [
            "user"=> $user,
            "token"=> $token->plainTextToken
        ];
    }
    public function login(){
        return "login";
    }
    public function logout(){
        return "logout";
    }
}
