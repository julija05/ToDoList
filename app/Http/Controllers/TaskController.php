<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TaskController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): Response
    {
        $user = Auth::user();

        $userTasks = Task::query()
            ->where('status', '=', '1')
            ->orWhere('user_id', '=', $user->id)
            ->orderBy("id", "DESC")
            ->paginate(self::PAGINATION_PER_PAGE);

        return
            $this->response(TaskResource::collection($userTasks));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTaskRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTaskRequest $request): Response
    {
        $request_data = $request->all();

        $request_data['user_id'] = Auth::user()->id;

        $task = Task::create($request_data);

        return $this->response(TaskResource::make($task));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task): Response
    {
        $currTask = $task;

        if (!$task->getTask($currTask)) {
            return $this->response([], [], Response::HTTP_NOT_FOUND, 'This module cannot be found');
        }

        return
            $this->response(TaskResource::make($currTask));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaskRequest  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaskRequest $request, $task): Response
    {
        $updateTask = Task::find($task);

        $this->authorize(__FUNCTION__, $updateTask);

        $request_data = $request->except('user_id');

        $updateTask->update($request_data);


        return
            $this->response(TaskResource::make($updateTask));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task): Response
    {
        $this->authorize(__FUNCTION__, $task);
        $task->delete();
        return $this->response([], [], Response::HTTP_NO_CONTENT);
    }
}
