<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'To-Do List')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 bg-light p-3">
                <h4>Menu</h4>
                <div class="sidebar-section">
                    <h5>TASKS</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('tasks.index') }}" class="text-decoration-none text-dark">Active Tasks</a>
                            <span class="badge bg-primary rounded-pill">{{ $activeTasks ?? 0 }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('tasks.completed') }}" class="text-decoration-none text-dark">Completed Tasks</a>
                            <span class="badge bg-success rounded-pill">{{ $completedTasksCount ?? 0 }}</span>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-section mt-4">
                    <h5>CATEGORIES</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Work</span>
                            <span class="badge bg-primary rounded-pill">{{ $workTasksList ?? 0 }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Personal</span>
                            <span class="badge bg-success rounded-pill">{{ $personalTasksList ?? 0 }}</span>
                        </li>
                    </ul>
                </div>
                <div class="sidebar-section mt-4">
                    <h5>PRIORITY</h5>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('tasks.priority', 'high') }}" class="text-decoration-none text-dark">High Priority</a>
                            <span class="badge bg-danger rounded-pill">{{ $highPriorityTasks ?? 0 }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('tasks.priority', 'medium') }}" class="text-decoration-none text-dark">Medium Priority</a>
                            <span class="badge bg-warning rounded-pill">{{ $mediumPriorityTasks ?? 0 }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('tasks.priority', 'low') }}" class="text-decoration-none text-dark">Low Priority</a>
                            <span class="badge bg-info rounded-pill">{{ $lowPriorityTasks ?? 0 }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Konten Utama -->
            <div class="col-md-9 p-4">
                @if(session('success'))
                    <script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: "{{ session('success') }}",
                            timer: 3000,
                            showConfirmButton: false
                        });
                    </script>
                @endif
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>

</html>
