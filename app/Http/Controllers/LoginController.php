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

            $basicToken = $user->createToken('basic-token');

            switch ($user->type) {
                case 'admin':
                    $adminToken = $user->createToken('admin-token');
                    break;
                case 'user':
                    $userToken = $user->createToken('user-token');
                    break;
                default:
                    $userToken = $user->createToken('user-token');
                    break;
            }

            return [
                "user" => $user,
                "tokens" => [
                    'basic' => $basicToken->plainTextToken,
                    'admin' => isset($adminToken) ? $adminToken->plainTextToken : null,
                    'user' => isset($userToken) ? $userToken->plainTextToken : null
                ]
            ];
        }
    }
}
