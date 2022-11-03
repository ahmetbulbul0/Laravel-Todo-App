@extends('layout', ['title' => 'Home'])

@section('body')
    <div class="container">
        <div class="sm-box">
            <div class="title size120">
                <span>Welcome To Todo App</span>
            </div>
            <div class="list">
                <div class="item center">
                    <a class="fullBtn bg-redPink" href="{{ route("login") }}">Login</a>
                </div>
                <div class="item center">
                    <a class="fullBtn bg-redPink" href="{{ route("register") }}">Register</a>
                </div>
            </div>
        </div>
    </div>
@endsection
