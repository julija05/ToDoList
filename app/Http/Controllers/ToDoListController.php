<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreToDoListRequest;
use App\Http\Requests\UpdateToDoListRequest;
use App\Http\Resources\ToDoListResource;
use App\Models\Task;
use App\Models\ToDoList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;



class ToDoListController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): Response
    {
        $user = Auth::user();

        $userLists = ToDoList::query()
            ->with('tasks')
            ->where('status', '=', '1')
            ->orWhere('user_id', '=', $user->id)
            ->orderBy('created_at', 'DESC')
            ->paginate(self::PAGINATION_PER_PAGE);


        return
            $this->response(ToDoListResource::collection($userLists));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreToDoListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreToDoListRequest $request): Response
    {
        // $this->authorize(__FUNCTION__, User::class);
        $request_data = $request->all();

        $request_data['user_id'] = Auth::user()->id;

        $list = ToDoList::create($request_data);

        return $this->response(ToDoListResource::make($list));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function show(ToDoList $toDoList, $id): Response
    {

        // $this->authorize(__FUNCTION__, $toDoList);
        $list = ToDoList::find($id);

        if (!$toDoList->getList($list)) {
            return $this->response([], [], Response::HTTP_NOT_FOUND, 'This module cannot be found');
        }

        $list->load('tasks');

        return $this->response(ToDoListResource::make($list));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function edit(ToDoList $toDoList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateToDoListRequest  $request
     * @param  \App\Models\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateToDoListRequest $request, $toDoList): Response
    {
        $updateList = ToDoList::find($toDoList);

        $this->authorize(__FUNCTION__, $updateList);

        $request_data = $request->except('user_id');

        $updateList->update($request_data);

        // dd($updateList->tasks);
        $status = $request_data["status"];

        // if ($status > 0) {
        Task::where('to_do_list_id', '=', $toDoList)->update(['status' => $status]);
        // }

        return
            $this->response(ToDoListResource::make($updateList));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToDoList $toDoList, $id)
    {
        $deleteList = ToDoList::find($id);
        $this->authorize(__FUNCTION__, $deleteList);



        $deleteList->delete();

        return $this->response([], [], Response::HTTP_NO_CONTENT);
    }
}
