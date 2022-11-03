@extends('layout', ['title' => 'Login'])

@section('body')
    <div class="container">
        <div class="sm-box">
            <div class="title size120">
                <span>Login</span>
            </div>
            <div class="subText mt6">
                <span>if you don't have an account, <a href="{{ route("register") }}">Register Here</a></span>
            </div>
            <form class="form mt12">
                <div class="line">
                    <label>Username or E-Mail:</label>
                    <input type="text" class="mt6">
                </div>
                <div class="line">
                    <label>Password:</label>
                    <input type="password" class="mt6">
                </div>
                <div class="line">
                    <button class="fullBtn bg-redPink">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection
