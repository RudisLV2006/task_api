<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            "title"=>"required|max:120",
            "description"=>"required",
            "due_time"=>"date|nullable"
        ]);

        $task = Task::create($fields);

        return [
            "task"=>$task
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return [
            "task"=>$task
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $fields = $request->validate([
            "title"=>"required|max:120",
            "description"=>"required",
            "due_time"=>"date|nullable"
        ]);
        $task->update($fields);

        return [
            "task"=>$task
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return [
            "message"=>"Task deleted"
        ];
    }
}
