@extends('layout', ['title' => 'Todo List'])

@section('body')
    <div class="container">
        <div class="md-box">
            <div class="header">
                <div class="title size140">
                    <span>My Todo's</span>
                </div>
                <div class="select">
                    <select>
                        <option selected disabled>Sorting</option>
                        <option>First Incomplete Todo's</option>
                        <option>First Completed Todo's</option>
                        <option>First Newest</option>
                        <option>First Oldest</option>
                    </select>
                </div>
                <div class="links">
                    <a href="{{ route("todo-add") }}" class="bg-redPink link">Add Todo</a>
                    <a href="{{ route("log-out") }}" class="bg-redPink link">Log Out</a>
                </div>
            </div>
            <div class="header">
                <div class="radios left">
                    <label>
                        <input type="radio" name="filter">
                        Completed Todo's
                    </label>
                    <label>
                        <input type="radio" name="filter">
                        Incomplete Todo's
                    </label>
                </div>
                <div class="text">
                    <input type="text" placeholder="Searh in my todos...">
                </div>
            </div>
            <div class="list">
                <div class="item column3 between">
                    <div class="links">
                        <a href="#" class="bg-darkGreen1 hoverGreen1 icon"><i class="fa-regular fa-circle-check"></i></a>
                        <a href="#">Aliqua qui ea magna aliquip esse minim officia. Labore magna dolor commodo veniam ex consectetur eiusmod est nulla. Nostrud aliqua fugiat anim incididunt nostrud ipsum veniam id do aliquip non pariatur consectetur voluptate. Ea aliqua nostrud commodo deserunt non ex occaecat irure sint tempor reprehenderit eiusmod voluptate cillum. Incididunt consequat Lorem id aute labore elit voluptate anim reprehenderit incididunt adipisicing. Est voluptate non nostrud elit anim ea. Laborum ad dolor ut nostrud in commodo esse ea.</a>
                    </div>
                    <div class="links">
                        <a href="#" class="bg-darkPink hoverPink icon"><i class="fa-solid fa-up-right-from-square"></i></a>
                        <a href="#" class="bg-darkRed hoverRed icon"><i class="fa-solid fa-trash"></i></a>
                        <a href="#" class="bg-darkGreen hoverGreen icon"><i class="fa-solid fa-pen-to-square"></i></a>
                    </div>
                </div>
            </div>
            {{-- <footer>
            <span class="subText">toplamda 12 adet todo kayıtına sahipsiniz</span>
        </footer> --}}
        </div>
    </div>
@endsection
