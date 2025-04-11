@extends('layouts.app')

@section('title', 'Tasks')

@section('content')
<style>
    .date-badge {
        background-color: #f8f9fa;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 0.85rem;
        color: #6c757d;
        border: 1px solid #dee2e6;
    }
    
    .task-item {
        transition: all 0.3s ease;
    }
    
    .task-item:hover {
        background-color: #f8f9fa;
    }
    
    .priority-badge {
        font-size: 0.75rem;
        padding: 3px 8px;
    }
    
    .task-controls {
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }
    
    .task-item:hover .task-controls {
        opacity: 1;
    }
    
    .task-details label {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 0.2rem;
    }
    
    .task-details p {
        font-size: 1rem;
        padding: 0.3rem 0.5rem;
        background-color: #f8f9fa;
        border-radius: 4px;
    }
    
    .modal-body {
        padding: 1.5rem;
    }
</style>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Tasks</h2>
</div>

<div class="row">
    <!-- Work Tasks -->
    <div class="col-md-6 p-2">
        <div class="card p-3">
            <h4>Work Tasks</h4>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTaskModal">+ Add New Task</button>
            <ul class="list-group">
                @forelse ($workTasks as $task)
                    <li class="list-group-item task-item d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <input type="checkbox" class="form-check-input me-2 toggle-status" 
                                    data-id="{{ $task->id }}" 
                                    {{ $task->status === 'completed' ? 'checked' : '' }}>
                                <span class="{{ $task->status === 'completed' ? 'text-decoration-line-through' : '' }}">
                                    {{ $task->name }}
                                </span>
                                <span class="badge priority-badge ms-2 
                                    {{ $task->priority === 'high' ? 'bg-danger' : 
                                       ($task->priority === 'medium' ? 'bg-warning' : 'bg-info') }}">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            </div>
                            <div class="date-badge">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $task->formatted_date }}
                            </div>
                        </div>
                        <div class="task-controls">
                            <button type="button" 
                                class="btn btn-info btn-sm show-task" 
                                data-id="{{ $task->id }}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" 
                                class="btn btn-warning btn-sm edit-task" 
                                data-id="{{ $task->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('tasks.destroy', $task->id) }}" 
                                method="POST" 
                                class="d-inline delete-task-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-task">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-center">No work tasks</li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Personal Tasks -->
    <div class="col-md-6 p-2">
        <div class="card p-3">
            <h4>Personal Tasks</h4>
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addTaskModal">+ Add New Task</button>
            <ul class="list-group">
                @forelse ($personalTasks as $task)
                    <li class="list-group-item task-item d-flex justify-content-between align-items-center">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <input type="checkbox" class="form-check-input me-2 toggle-status" 
                                    data-id="{{ $task->id }}" 
                                    {{ $task->status === 'completed' ? 'checked' : '' }}>
                                <span class="{{ $task->status === 'completed' ? 'text-decoration-line-through' : '' }}">
                                    {{ $task->name }}
                                </span>
                                <span class="badge priority-badge ms-2 
                                    {{ $task->priority === 'high' ? 'bg-danger' : 
                                       ($task->priority === 'medium' ? 'bg-warning' : 'bg-info') }}">
                                    {{ ucfirst($task->priority) }}
                                </span>
                            </div>
                            <div class="date-badge">
                                <i class="fas fa-calendar-alt me-1"></i>
                                {{ $task->formatted_date }}
                            </div>
                        </div>
                        <div class="task-controls">
                            <button type="button" 
                                class="btn btn-info btn-sm show-task" 
                                data-id="{{ $task->id }}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button type="button" 
                                class="btn btn-warning btn-sm edit-task" 
                                data-id="{{ $task->id }}">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('tasks.destroy', $task->id) }}" 
                                method="POST" 
                                class="d-inline delete-task-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-task">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-center">No personal tasks</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Task Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="work">Work</option>
                            <option value="personal">Personal</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <select class="form-control" id="priority" name="priority" required>
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editTaskForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Task Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_type" class="form-label">Type</label>
                        <select class="form-control" id="edit_type" name="type" required>
                            <option value="work">Work</option>
                            <option value="personal">Personal</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_priority" class="form-label">Priority</label>
                        <select class="form-control" id="edit_priority" name="priority" required>
                            <option value="high">High</option>
                            <option value="medium">Medium</option>
                            <option value="low">Low</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="edit_date" name="date" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_note" class="form-label">Note</label>
                        <textarea class="form-control" id="edit_note" name="note"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Show Modal -->
<div class="modal fade" id="showTaskModal" tabindex="-1" aria-labelledby="showTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showTaskModalLabel">Task Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="task-details">
                    <div class="mb-3">
                        <label class="fw-bold">Task Name</label>
                        <p id="show_name" class="mb-0"></p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Type</label>
                        <p id="show_type" class="mb-0"></p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Priority</label>
                        <p id="show_priority" class="mb-0"></p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Due Date</label>
                        <p id="show_date" class="mb-0"></p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Status</label>
                        <p id="show_status" class="mb-0"></p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Note</label>
                        <p id="show_note" class="mb-0"></p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Created At</label>
                        <p id="show_created_at" class="mb-0"></p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Last Updated</label>
                        <p id="show_updated_at" class="mb-0"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Make priority badges clickable
    const priorityBadges = document.querySelectorAll('.priority-badge');
    priorityBadges.forEach(badge => {
        badge.style.cursor = 'pointer';
        badge.addEventListener('click', function() {
            const priority = this.textContent.trim();
            Swal.fire({
                title: `${priority} Priority`,
                text: `This task has ${priority.toLowerCase()} priority`,
                icon: priority.toLowerCase() === 'high' ? 'error' : 
                      priority.toLowerCase() === 'medium' ? 'warning' : 'info'
            });
        });
    });

    // Edit Task
    const editButtons = document.querySelectorAll('.edit-task');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const taskId = this.dataset.id;
            fetch(`/tasks/${taskId}/edit`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('edit_name').value = data.name;
                    document.getElementById('edit_type').value = data.type;
                    document.getElementById('edit_priority').value = data.priority;
                    document.getElementById('edit_date').value = data.date;
                    document.getElementById('edit_note').value = data.note;
                    
                    const editForm = document.getElementById('editTaskForm');
                    editForm.action = `/tasks/${taskId}`;
                    
                    const editModal = new bootstrap.Modal(document.getElementById('editTaskModal'));
                    editModal.show();
                });
        });
    });

    // Delete Task
    const deleteButtons = document.querySelectorAll('.delete-task');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Handle form submission for edit
    const editForm = document.getElementById('editTaskForm');
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        fetch(this.action, {
            method: 'POST',
            body: new FormData(this),
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                const editModal = bootstrap.Modal.getInstance(document.getElementById('editTaskModal'));
                editModal.hide();
                
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Task has been updated successfully!',
                    timer: 3000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            }
        });
    });

    // Show Task Details
    const showButtons = document.querySelectorAll('.show-task');
    showButtons.forEach(button => {
        button.addEventListener('click', function() {
            const taskId = this.dataset.id;
            fetch(`/tasks/${taskId}/show`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('show_name').textContent = data.name;
                    document.getElementById('show_type').textContent = data.type.charAt(0).toUpperCase() + data.type.slice(1);
                    
                    // Set priority with badge
                    const priorityElement = document.getElementById('show_priority');
                    const priorityClass = data.priority === 'high' ? 'danger' : 
                                        (data.priority === 'medium' ? 'warning' : 'info');
                    priorityElement.innerHTML = `<span class="badge bg-${priorityClass}">${data.priority.toUpperCase()}</span>`;
                    
                    document.getElementById('show_date').textContent = data.formatted_date;
                    document.getElementById('show_status').textContent = data.status.charAt(0).toUpperCase() + data.status.slice(1);
                    document.getElementById('show_note').textContent = data.note || 'No notes';
                    
                    // Format timestamps
                    const created = new Date(data.created_at).toLocaleString();
                    const updated = new Date(data.updated_at).toLocaleString();
                    document.getElementById('show_created_at').textContent = created;
                    document.getElementById('show_updated_at').textContent = updated;
                    
                    const showModal = new bootstrap.Modal(document.getElementById('showTaskModal'));
                    showModal.show();
                });
        });
    });

    const toggleButtons = document.querySelectorAll('.toggle-status');
    toggleButtons.forEach(button => {
        button.addEventListener('change', function() {
            const taskId = this.dataset.id;
            fetch(`/tasks/${taskId}/toggle-status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Task Updated!',
                        text: data.status === 'completed' ? 'Task marked as completed!' : 'Task marked as pending!',
                        timer: 1500,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.reload();
                    });
                }
            });
        });
    });
});
</script>
@endpush
@endsection
