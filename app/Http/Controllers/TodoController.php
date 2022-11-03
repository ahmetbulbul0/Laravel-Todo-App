<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoCollection;
use App\Http\Resources\TodoResource;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TodoCollection(Todo::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTodoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoRequest $request)
    {
        $data = [
            "content" => htmlspecialchars($request->content),
            "user" => intval($request->user),
            "added_time" => date("Y-m-d/H:i:s"),
            "is_completed" => false
        ];
        $create = Todo::create($data);
        return new TodoResource($create);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        return new TodoResource($todo);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTodoRequest  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTodoRequest $request, Todo $todo)
    {
        $data = [
            "content" => $request->content ? htmlspecialchars($request->content) : $todo->content,
        ];
        $update = Todo::where("id", $todo->id);
        $update = Todo::where("id", $todo->id)->update(["is_completed" => $request->isCompleted ?? $todo->is_completed]); /* because it is boolean */

        $todo = Todo::where("id", $todo->id)->first();
        return new TodoResource($todo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return "Todo Successfully Deleted";
    }
}
