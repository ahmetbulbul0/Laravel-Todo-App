<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function index(StoreUserRequest $request)
    {
        $fullName = $request->fullName;
        $username = $request->username;
        $password = $request->password;
        $email = $request->email;
        $type = $request->type;

        $data = [
            "full_name" => Str::lower($fullName),
            "username" => Str::slug($username),
            "password" => Hash::make($password),
            "email" => Str::lower($email),
            "type" =>  Str::lower($type),
        ];
        $create = User::create($data);
        return new UserResource($create);
    }
}
