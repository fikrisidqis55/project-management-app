<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Notification;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::with('user', 'project')->get();
    }

    public function store(Request $request)
    {
        $task = Task::create($request->all());
        // Notify team member
        Notification::create([
            // 'user_id' => $task->user_id,
            'type' => 'task_assigned',
            'data' => json_encode($task),
        ]);
        return response()->json($task, 201);
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->all());
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
