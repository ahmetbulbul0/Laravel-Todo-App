<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;
use App\Http\Resources\TodoCollection;
use App\Http\Resources\TodoResource;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->user()->currentAccessToken()->can("all-todos-list")) {
            return new TodoCollection(Todo::get());
        } else {
            return new TodoCollection(Todo::where("user", $request->user()->id)->get());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTodoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTodoRequest $request)
    {
        if ($request->user()->currentAccessToken()->can("todo-create")) {
            $data = [
                "content" => htmlspecialchars($request->content),
                "user" => $request->user()->id,
                "added_time" => date("Y-m-d/H:i:s"),
                "is_completed" => false
            ];
            $create = Todo::create($data);
            return new TodoResource($create);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo, Request $request)
    {
        $todo = Todo::where("id", $todo->id)->with("userData")->first();
        if ($request->user()->currentAccessToken()->can("all-todos-list")) {
            return new TodoResource($todo);
        } else {
            if ($todo->user == $request->user()->id) {
                return new TodoResource($todo);
            } else {
                return ["status" => "failed"];
            }
        }
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
        if ($request->user()->currentAccessToken()->can("all-todos-update")) {
            $data = [
                "content" => $request->content ? htmlspecialchars($request->content) : $todo->content,
            ];
            $update = Todo::where("id", $todo->id);
            $update = Todo::where("id", $todo->id)->update(["is_completed" => $request->isCompleted ?? $todo->is_completed]); /* because it is boolean */

            $todo = Todo::where("id", $todo->id)->first();
            return new TodoResource($todo);
        } else {
            if ($todo->user == $request->user()->id) {
                $data = [
                    "content" => $request->content ? htmlspecialchars($request->content) : $todo->content,
                ];
                $update = Todo::where("id", $todo->id);
                $update = Todo::where("id", $todo->id)->update(["is_completed" => $request->isCompleted ?? $todo->is_completed]); /* because it is boolean */

                $todo = Todo::where("id", $todo->id)->first();
                return new TodoResource($todo);
            } else {
                return ["status" => "failed"];
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo, Request $request)
    {
        if ($request->user()->currentAccessToken()->can("all-todos-delete")) {
            $todo->delete();
            return "Todo Successfully Deleted";
        } else {
            if ($todo->user == $request->user()->id) {
                $todo->delete();
                return "Todo Successfully Deleted";
            } else {
                return ["status" => "failed"];
            }
        }
    }
}
