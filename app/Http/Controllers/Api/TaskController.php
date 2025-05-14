<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $tasks =Task::where('user_id', Auth::id())->with('status')->get();

        return response()->json($tasks);
    }

    public function store(StoreTaskRequest $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }


        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $task =Task::create($data);

        return response()->json($task, 201);
    }

    public function show(Task $task)
    {
        if (!Auth::check() || $task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($task->load('status'));
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        if (!Auth::check() || $task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->update($request->validated());

        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        if (!Auth::check() || $task->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $task->delete();

        return response()->json(['message' => 'Task deleted successfully']);
    }
}
