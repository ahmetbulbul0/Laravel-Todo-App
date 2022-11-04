<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        $username = htmlspecialchars($request->username);
        $password = $request->password;
        $user = User::where(["username" => $username, "password" => $password])->first();
        if (!$user) {
            return "failed";
        }
        if ($user) {
            return "ok";
        }
    }
}
