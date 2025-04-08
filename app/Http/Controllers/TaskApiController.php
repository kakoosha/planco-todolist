<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskApiController extends Controller
{
    public function index()
    {
        return response()->json(['tasks' => Task::all()], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task = Task::create([
            'title' => $validated['title'],
            'completed' => false // Ensures consistency
        ]);

        return response()->json([
            'message' => 'Task created successfully!',
            'task' => $task
        ], 201);
    }

    public function show($id)
    {
        $task = Task::find($id);
    
        if (!$task) {
            return response()->json([
                'message' => 'Task not found'
            ], 404);
        }
    
        return response()->json([
            'message' => 'Task found',
            'task' => $task
        ], 200);
    }
    
    public function update(Request $request, $id)
    {
    $task = Task::find($id);

    if (!$task) {
        return response()->json([
            'message' => 'Task not found'
        ], 404);
    }

    $task->update($request->all());

    return response()->json([
        'message' => 'Task updated successfully',
        'task' => $task
    ], 200);
    }


    public function toggle(Task $task)
    {
        $task->completed = !$task->completed;
        $task->save();
        
        return response()->json([
            'message' => 'Task status toggled',
            'task' => $task
        ], 200);
    }

    public function destroy($id)
    {
    $task = Task::find($id);

    if (!$task) {
        return response()->json([
            'message' => 'Task not found'
        ], 404);
    }

    $task->delete();

    return response()->json([
        'message' => 'Task deleted successfully'
    ], 200);
    }
}
