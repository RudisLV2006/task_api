<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class SubtaskController extends Controller
{
    public function store(Request $request, Task $task){
        $fields = $request->validate([
            "content"=>"required"
        ]);

        $subtask = $task->subTasks()->create($fields);

        return [
            "subtask"=>$subtask
        ];
    }
}
