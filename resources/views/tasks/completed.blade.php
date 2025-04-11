@extends('layouts.app')

@section('title', 'Completed Tasks')

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
</style>

<div class="row">
    <div class="col-12">
        <h2 class="mb-4">Completed Tasks</h2>
        <div class="card">
            <div class="card-body">
                <ul class="list-group">
                    @forelse ($completedTasks as $task)
                        <li class="list-group-item task-item d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <input type="checkbox" class="form-check-input me-2 toggle-status" 
                                        data-id="{{ $task->id }}" checked>
                                    <span class="text-decoration-line-through">{{ $task->name }}</span>
                                    <span class="badge ms-2 {{ $task->type === 'work' ? 'bg-primary' : 'bg-success' }}">
                                        {{ ucfirst($task->type) }}
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
                                    <small class="text-muted ms-2">Completed {{ $task->updated_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="list-group-item text-center">No completed tasks</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
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
                    window.location.reload();
                }
            });
        });
    });
});
</script>
@endpush
@endsection