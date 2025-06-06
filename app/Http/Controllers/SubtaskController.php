<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Gate;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class SubtaskController extends Controller implements HasMiddleware
{
    public static function middleware(){
        return [
            new Middleware("auth:sanctum", except : ["index"])
        ];
    } 
    public function index(Task $task){
        return $task->subtasks;
    }
    public function store(Request $request, Task $task){
        Gate::authorize('modify',$task);
        $fields = $request->validate([
            "content"=>"required"
        ]);

        $subtask = $task->subTasks()->create($fields);

        return [
            "subtask"=>$subtask
        ];
    }
}
