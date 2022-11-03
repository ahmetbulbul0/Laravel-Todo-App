@extends('layout', ['title' => 'Register'])

@section('body')
    <div class="container">
        <div class="sm-box">
            <div class="title size120">
                <span>Register</span>
            </div>
            <div class="subText mt6">
                <span>if you have an account, <a href="{{ route("login") }}">Login Here</a></span>
            </div>
            <form class="form mt12">
                <div class="line">
                    <label>Full Name:</label>
                    <input type="text" class="mt6">
                </div>
                <div class="line">
                    <label>Username:</label>
                    <input type="text" class="mt6">
                </div>
                <div class="line">
                    <label>Password:</label>
                    <input type="password" class="mt6">
                </div>
                <div class="line">
                    <label>E-Mail:</label>
                    <input type="email" class="mt6">
                </div>
                <div class="line">
                    <button class="fullBtn bg-redPink">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection
