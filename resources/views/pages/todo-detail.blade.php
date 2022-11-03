@extends('layout', ['title' => 'Todo Detail'])

@section('body')
    <div class="container">
        <div class="md-box">
            <div class="header">
                <div class="title size140">
                    <span>Todo Detail</span>
                </div>
                <div class="links">
                    <a href="{{ route('todo-edit') }}" class="bg-green link"><i class="fa-solid fa-pen-to-square"></i></a>
                    <a href="#" class="bg-red link"><i class="fa-solid fa-trash"></i></a>
                    <a href="{{ route('todo-list') }}" class="bg-redPink link">My Todo's</a>
                    <a href="{{ route('todo-add') }}" class="bg-redPink link">Add Todo</a>
                    <a href="{{ route('log-out') }}" class="bg-redPink link">Log Out</a>
                </div>
            </div>
            <div class="list">
                <div class="item block">
                    <label>Content:</label>
                    <textarea class="mt12 h140">Consectetur sit est do cupidatat enim quis eu sunt aliquip dolore eu quis. Culpa elit id consequat nisi mollit. Sint tempor deserunt ex consectetur nisi enim adipisicing deserunt cupidatat proident. Ad irure magna aliquip enim laboris proident ullamco aute nisi. Velit eiusmod ea culpa aliqua nisi aliqua quis.</textarea>
                </div>
                <div class="item block">
                    <label>Added Time:</label>
                    <div class="item">
                        <input type="date" value="2002-04-02" readonly>
                        <input type="time" value="12:45" readonly>
                    </div>
                </div>
                <div class="item block">
                    <label>Is Completed:</label>
                    <input type="text" value="no" readonly  class="mt12">
                </div>
                <div class="item block">
                    <label>User:</label>
                    <input type="text" value="Ahmet Bülbül (ahmetbulbul)" readonly class="mt12">
                </div>
            </div>
        </div>
    </div>
@endsection
