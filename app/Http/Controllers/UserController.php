<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserCollection;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new UserCollection(User::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $data = [
            "full_name" => Str::lower($request->fullName),
            "username" => Str::slug($request->username),
            "password" => Hash::make($request->password),
            "email" => Str::lower($request->email),
            "type" => Str::lower($request->type),
        ];
        $create = User::create($data);
        return new UserResource($create);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = [
            "full_name" => $request->fullName ? Str::lower($request->fullName) : $user->full_name,
            "username" => $request->username ? Str::slug($request->username) : $user->username,
            "password" => $request->password ? Hash::make($request->password) : $user->password,
            "email" => $request->email ? Str::lower($request->email) : $user->email,
            "type" => $request->type ? Str::lower($request->type) : $user->type,
        ];
        $update = User::where("id", $user->id)->update($data);
        $user = User::where("id", $user->id)->first();
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return "User Successfully Deleted";
    }
}
