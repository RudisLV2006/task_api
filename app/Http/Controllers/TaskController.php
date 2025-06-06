<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller implements HasMiddleware
{
    public static function middleware(){
        return [
            new Middleware("auth:sanctum", except : ["index","show"])
        ];
    } 
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

        $task = $request->user()->tasks()->create($fields);

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
        Gate::authorize('modify',$task);
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
        Gate::authorize('modify',$task);
        
        $task->delete();

        return [
            "message"=>"Task deleted"
        ];
    }
}
