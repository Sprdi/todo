@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
    <h2>Tasks</h2>
    <div class="card p-3">
        <h4>Today</h4>
        <button class="btn btn-primary">+ Add New Task</button>
        <ul class="list-group mt-3">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        <input type="checkbox" {{ $task->completed ? 'checked' : '' }}>
                        {{ $task->title }}
                    </span>
                    <span>
                        <a href="{{ route('tasks.update', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tasks.delete', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
    
    <div class="sidebar">
        <h3 class="mb-4">Menu</h3>
        <div class="menu-section mb-4">
            <h4 class="mb-3">TASKS</h4>
            <ul class="list-unstyled">
                <li class="d-flex justify-content-between align-items-center mb-2">
                    <span><i class="fas fa-tasks mr-2"></i> Tasks</span> <span>1</span>
                </li>
                <li class="d-flex justify-content-between align-items-center mb-2">
                    <span><i class="fas fa-sticky-note mr-2"></i> Sticky Wall</span> <span>1</span>
                </li>
            </ul>
        </div>
        <div class="menu-section mb-4">
            <h4 class="mb-3">LISTS</h4>
            <ul class="list-unstyled">
                <li class="d-flex justify-content-between align-items-center mb-2">
                    <span>High Priority</span> <span>1</span>
                </li>
                <li class="d-flex justify-content-between align-items-center mb-2">
                    <span>Personal</span> <span>1</span>
                </li>
                <li class="d-flex justify-content-between align-items-center mb-2">
                    <span>Work</span> <span>1</span>
                </li>
                <li><button class="btn btn-link p-0">Add New List</button></li>
            </ul>
        </div>
        <div class="menu-section">
            <h4 class="mb-3">TO-DO</h4>
            <ul class="list-unstyled">
                <li class="d-flex align-items-center mb-2">
                    <input type="checkbox" class="mr-2" checked> Checked TO-DO
                </li>
                <li class="d-flex align-items-center mb-2">
                    <input type="checkbox" class="mr-2"> Unchecked TO-DO
                </li>
            </ul>
        </div>
    </div>
    
    <div class="card p-3 mt-4">
        <h4>Tomorrow</h4>
        <button class="btn btn-primary">+ Add New Task</button>
        <ul class="list-group mt-3">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        <input type="checkbox" {{ $task->completed ? 'checked' : '' }}>
                        {{ $task->title }}
                    </span>
                    <span>
                        <a href="{{ route('tasks.update', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tasks.delete', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>
    
    <div class="card p-3 mt-4">
        <h4>This Week</h4>
        <button class="btn btn-primary">+ Add New Task</button>
        <ul class="list-group mt-3">
            @foreach ($tasks as $task)
                <li class="list-group-item d-flex justify-content-between">
                    <span>
                        <input type="checkbox" {{ $task->completed ? 'checked' : '' }}>
                        {{ $task->title }}
                    </span>
                    <span>
                        <a href="{{ route('tasks.update', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('tasks.delete', $task->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </span>
                </li>
            @endforeach
        </ul>
    </div>

@endsection
