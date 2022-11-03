@extends('layout', ['title' => 'Todo Add'])

@section('body')
    <div class="container">
        <div class="md-box">
            <div class="header">
                <div class="title size140">
                    <span>Todo Add</span>
                </div>
                <div class="links">
                    <a href="{{ route("todo-add") }}" class="bg-redPink link">Add Todo</a>
                    <a href="{{ route("log-out") }}" class="bg-redPink link">Log Out</a>
                </div>
            </div>
            <form class="form mt12">
                <div class="line">
                    <label>Content:</label>
                    <textarea class="mt6 h140"></textarea>
                </div>
                <div class="line">
                    <button class="fullBtn bg-green">Add Todo</button>
                </div>
            </form>
        </div>
    </div>
@endsection
