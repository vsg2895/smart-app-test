<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\TaskActionHistory;
use App\Models\User;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return TaskResource::collection(Task::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return TaskResource
     */
    public function store(StoreTaskRequest $request)
    {
        $task = Task::create($request->validated());

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Task $task
     * @return TaskResource
     */
    public function update(StoreTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        TaskActionHistory::create([
            'task_id' => $task->id,
            'updated' => json_encode($request->validated())
        ]);

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(['data' => 'Task Deleted Successfully']);
    }

    public function userTasks(User $user): \Illuminate\Http\JsonResponse
    {
        return response()->json(['data' => $user->tasks]);
    }

    public function tasksHistoryAll(): \Illuminate\Http\JsonResponse
    {
        return response()->json(['data' => TaskActionHistory::all()]);
    }

    public function tasksHistoryByTask(Task $task): \Illuminate\Http\JsonResponse
    {
        return response()->json(['data' => $task->history]);
    }

}
