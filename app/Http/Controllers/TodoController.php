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
        $data = new Todo();
        switch ($request->isCompleted) {
            case 'yes':
                $data = $data->where("is_completed", true);
                break;
            case 'no':
                $data = $data->where("is_completed", false);
                break;
            default:
                break;
        }
        switch ($request->sorting) {
            case 'isCompleted09':
                $data = $data->orderBy("is_completed", "ASC");
                break;
            case 'isCompleted90':
                $data = $data->orderBy("is_completed", "DESC");
                break;
            case 'addedTime09':
                $data = $data->orderBy("added_time", "ASC");
                break;
            case 'addedTime90':
                $data = $data->orderBy("added_time", "DESC");
                break;
            default:
                $data = $data->orderBy("added_time", "DESC");
                break;
        }
        if (!$request->user()->currentAccessToken()->can("all-todos-list")) {
            $data = $data->where("user", $request->user()->id);
        }
        if ($request->search) {
            $search = htmlspecialchars($request->search);
            $data = $data->where("content", "like", "%" . $search . "%");
        }
        $page = intval($request->page) ? intval($request->page) : 1;
        $data = TodoController::paginate($data, $page, 10);
        $response = [
            "data" => new TodoCollection($data["data"]),
            "paginate" => $data["pagination"]
        ];
        return $response;
    }

    static function paginate($data, $page, $itemPerPage)
    {
        $dataNumber = count($data->get());

        $TotalPageNumber = TodoController::getTotalPageNumber($dataNumber, $itemPerPage);

        $offsetValue = ($page * $itemPerPage) - $itemPerPage;

        $data = $data->limit($itemPerPage);
        $data = $data->offset($offsetValue);
        $data = $data->get();

        $response["data"] = $data;

        $response["pagination"] = [
            "nowPage" => $page,
            "previousPage" => $page > 1 ? $page - 1 : null,
            "previousPreviousPage" => $page > 2 ? $page - 2 : null,
            "nextPage" => $page < $TotalPageNumber ? $page + 1 : null,
            "nextNextPage" => $page + 1 < $TotalPageNumber ? $page + 2 : null,
            "totalPageNumber" => $TotalPageNumber,
        ];

        return $response;
    }

    static function getTotalPageNumber($dataNumber, $itemPerPage)
    {
        $totalPageNumber = 1;
        if ($dataNumber > $itemPerPage) {
            $totalPageNumber = intval($dataNumber / $itemPerPage);
            if (($dataNumber % $itemPerPage) > 0) {
                $totalPageNumber++;
            }
        }
        return $totalPageNumber;
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
            $update = Todo::where("id", $todo->id)->update(["content" => $request->content ? htmlspecialchars($request->content) : $todo->content, "is_completed" => $request->isCompleted]);
            $todo = Todo::where("id", $todo->id)->first();
            return new TodoResource($todo);
        } else {
            if ($todo->user == $request->user()->id) {
                $update = Todo::where("id", $todo->id)->update(["content" => $request->content ? htmlspecialchars($request->content) : $todo->content, "is_completed" => $request->isCompleted]);
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
