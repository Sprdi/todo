<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tasks;

class TasksController extends Controller
{

    public function index() {
        $tasks = tasks::all();
        return view('tasks.index', compact('tasks'));
    }

    // Create a new task
    public function create(Request $request) {
        $task = new tasks();
        $task->name = $request->name;
        $task->type = $request->type;
        $task->date = $request->date;
        $task->note = $request->note;
        $task->status = $request->status;
        $task->save();

        return response()->json($task, 201);
    }

    // Update an existing task
    public function update(Request $request, $id) {
        $task = tasks::findOrFail($id);
        $task->name = $request->name;
        $task->type = $request->type;
        $task->date = $request->date;
        $task->note = $request->note;
        $task->status = $request->status;
        $task->save();

        return response()->json($task, 200);
    }

    // Delete a task
    public function delete($id) {
        $task = tasks::findOrFail($id);
        $task->delete();

        return response()->json(null, 204);
    }
}