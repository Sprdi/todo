<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'To-Do List')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 bg-light p-3">
                <h4>Menu</h4>
                <ul class="list-group">
                    <li class="list-group-item"><a href="{{ route('tasks.index') }}">Tasks</a></li>
                    {{-- <li class="list-group-item"><a href="{{ route('stickywall') }}">Sticky Wall</a></li> --}}
                </ul>
            </div>

            <!-- Konten Utama -->
            <div class="col-md-9 p-4">
                @yield('content')
            </div>
        </div>
    </div>

</body>
</html>
