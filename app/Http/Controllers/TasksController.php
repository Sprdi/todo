<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tasks;
use Carbon\Carbon;

class TasksController extends Controller
{
    public function index() {
        // Get sidebar counts
        $activeTasks = tasks::where('status', 'pending')->count();
        $completedTasksCount = tasks::where('status', 'completed')->count();
        $workTasksCount = tasks::where('type', 'work')->where('status', 'pending')->count();
        $personalTasksCount = tasks::where('type', 'personal')->where('status', 'pending')->count();
        $highPriorityTasks = tasks::where('priority', 'high')->where('status', 'pending')->count();
        $mediumPriorityTasks = tasks::where('priority', 'medium')->where('status', 'pending')->count();
        $lowPriorityTasks = tasks::where('priority', 'low')->where('status', 'pending')->count();

        // Get tasks for display
        $workTasksList = tasks::where('type', 'work')
            ->where('status', 'pending')
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($task) {
                $task->formatted_date = Carbon::parse($task->date)->format('D, d M Y');
                return $task;
            });
            
        $personalTasksList = tasks::where('type', 'personal')
            ->where('status', 'pending')
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($task) {
                $task->formatted_date = Carbon::parse($task->date)->format('D, d M Y');
                return $task;
            });
        
        return view('tasks.index', [
            'workTasks' => $workTasksList,
            'personalTasks' => $personalTasksList,
            'activeTasks' => $activeTasks,
            'completedTasksCount' => $completedTasksCount,
            'workTasksCount' => $workTasksCount,
            'personalTasksCount' => $personalTasksCount,
            'highPriorityTasks' => $highPriorityTasks,
            'mediumPriorityTasks' => $mediumPriorityTasks,
            'lowPriorityTasks' => $lowPriorityTasks,
        ]);
    }

    public function completed() {
        // Get sidebar counts
        $activeTasks = tasks::where('status', 'pending')->count();
        $completedTasksCount = tasks::where('status', 'completed')->count();
        $workTasks = tasks::where('type', 'work')->where('status', 'pending')->count();
        $personalTasks = tasks::where('type', 'personal')->where('status', 'pending')->count();
        $highPriorityTasks = tasks::where('priority', 'high')->where('status', 'pending')->count();
        $mediumPriorityTasks = tasks::where('priority', 'medium')->where('status', 'pending')->count();
        $lowPriorityTasks = tasks::where('priority', 'low')->where('status', 'pending')->count();

        // Get completed tasks list
        $completedTasksList = tasks::where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->get()
            ->map(function ($task) {
                $task->formatted_date = Carbon::parse($task->date)->format('D, d M Y');
                return $task;
            });
        
        return view('tasks.completed', [
            'completedTasks' => $completedTasksList,
            'activeTasks' => $activeTasks,
            'completedTasksCount' => $completedTasksCount,
            'workTasks' => $workTasks,
            'personalTasks' => $personalTasks,
            'highPriorityTasks' => $highPriorityTasks,
            'mediumPriorityTasks' => $mediumPriorityTasks,
            'lowPriorityTasks' => $lowPriorityTasks,
        ]);
    }

    public function toggleStatus(tasks $task)
    {
        $task->status = $task->status === 'completed' ? 'pending' : 'completed';
        $task->save();
        
        return response()->json([
            'success' => true,
            'status' => $task->status
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:work,personal',
            'priority' => 'required|in:high,medium,low',
            'date' => 'required|date',
            'note' => 'nullable'
        ]);

        tasks::create([
            'name' => $request->name,
            'type' => $request->type,
            'priority' => $request->priority,
            'date' => $request->date,
            'note' => $request->note,
            'status' => 'pending'
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }

    public function edit(tasks $task)
    {
        return response()->json($task);
    }

    public function update(Request $request, tasks $task)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required|in:work,personal',
            'priority' => 'required|in:high,medium,low',
            'date' => 'required|date',
            'note' => 'nullable'
        ]);

        $task->update([
            'name' => $request->name,
            'type' => $request->type,
            'priority' => $request->priority,
            'date' => $request->date,
            'note' => $request->note
        ]);

        if($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }

    public function destroy(tasks $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }

    public function show(tasks $task)
    {
        $task->formatted_date = Carbon::parse($task->date)->format('D, d M Y');
        return response()->json($task);
    }

    public function priority($priority) {
        // Validate priority
        if (!in_array($priority, ['high', 'medium', 'low'])) {
            abort(404);
        }
        
        // Get sidebar counts
        $activeTasks = tasks::where('status', 'pending')->count();
        $completedTasksCount = tasks::where('status', 'completed')->count();
        $workTasksCount = tasks::where('type', 'work')->where('status', 'pending')->count();
        $personalTasksCount = tasks::where('type', 'personal')->where('status', 'pending')->count();
        $highPriorityTasks = tasks::where('priority', 'high')->where('status', 'pending')->count();
        $mediumPriorityTasks = tasks::where('priority', 'medium')->where('status', 'pending')->count();
        $lowPriorityTasks = tasks::where('priority', 'low')->where('status', 'pending')->count();

        // Get tasks for display filtered by priority
        $workTasksList = tasks::where('type', 'work')
            ->where('status', 'pending')
            ->where('priority', $priority)
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($task) {
                $task->formatted_date = Carbon::parse($task->date)->format('D, d M Y');
                return $task;
            });
            
        $personalTasksList = tasks::where('type', 'personal')
            ->where('status', 'pending')
            ->where('priority', $priority)
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($task) {
                $task->formatted_date = Carbon::parse($task->date)->format('D, d M Y');
                return $task;
            });
        
        return view('tasks.index', [
            'workTasks' => $workTasksList,
            'personalTasks' => $personalTasksList,
            'activeTasks' => $activeTasks,
            'completedTasksCount' => $completedTasksCount,
            'workTasksCount' => $workTasksCount,
            'personalTasksCount' => $personalTasksCount,
            'highPriorityTasks' => $highPriorityTasks,
            'mediumPriorityTasks' => $mediumPriorityTasks,
            'lowPriorityTasks' => $lowPriorityTasks,
            'currentPriority' => $priority,
        ]);
    }
}