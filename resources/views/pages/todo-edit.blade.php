@extends('layout', ['title' => 'Todo Edit'])

@section('body')
    <div class="container">
        <div class="md-box">
            <div class="header">
                <div class="title size140">
                    <span>Todo Edit</span>
                </div>
                <div class="links">
                    <a href="{{ route('todo-list') }}" class="bg-redPink link">My Todo's</a>
                    <a href="{{ route('todo-add') }}" class="bg-redPink link">Add Todo</a>
                    <a href="{{ route('log-out') }}" class="bg-redPink link">Log Out</a>
                </div>
            </div>
            <form class="form mt12">
                <div class="line">
                    <label>Content:</label>
                    <textarea class="mt6 h140">Consectetur sit est do cupidatat enim quis eu sunt aliquip dolore eu quis. Culpa elit id consequat nisi mollit. Sint tempor deserunt ex consectetur nisi enim adipisicing deserunt cupidatat proident. Ad irure magna aliquip enim laboris proident ullamco aute nisi. Velit eiusmod ea culpa aliqua nisi aliqua quis.</textarea>
                </div>
                <div class="line">
                    <label>Is Completed:</label>
                    <div class="radios around">
                        <label>
                            <input type="radio" name="isCompleted" value="yes">
                            Yes
                        </label>
                        <label>
                            <input type="radio" name="isCompleted" value="no" checked>
                            No
                        </label>
                    </div>
                </div>
                <div class="line">
                    <button class="fullBtn bg-green">Edit Todo</button>
                </div>
            </form>
        </div>
    </div>
@endsection
