<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $credentials = [
            "email" => $email,
            "password" => $password
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            switch ($user->type) {
                case 'admin':
                    $token = $user->createToken('token', ["all-todos-list", "all-todos-delete", "all-todos-update"]);
                    break;
                case 'user':
                    $token = $user->createToken('token', ["todo-create"]);
                    break;
                default:
                    $token = $user->createToken('token', ["todo-create"]);
                    break;
            }

            return [
                "status" => "ok",
                "user" => $user,
                "token" => $token->plainTextToken
            ];
        } else {
            return [
                "status" => "failed"
            ];
        }
    }
}
