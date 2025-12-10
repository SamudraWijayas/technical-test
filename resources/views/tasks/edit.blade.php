@extends('layouts.app')

@section('content')
<h1>Edit Task</h1>

<form action="{{ route('tasks.update', $task) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="project_id" class="form-label">Project</label>
        <select name="project_id" id="project_id" class="form-select" required>
            <option value="">Select Project</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}" {{ $task->project_id == $project->id ? 'selected' : '' }}>
                    {{ $project->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $task->title }}" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control">{{ $task->description }}</textarea>
    </div>

    <div class="mb-3">
        <label for="priority" class="form-label">Priority</label>
        <select name="priority" id="priority" class="form-select" required>
            <option value="1" {{ $task->priority == 1 ? 'selected' : '' }}>Low</option>
            <option value="2" {{ $task->priority == 2 ? 'selected' : '' }}>Medium</option>
            <option value="3" {{ $task->priority == 3 ? 'selected' : '' }}>High</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
            <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>Todo</option>
            <option value="2" {{ $task->status == 2 ? 'selected' : '' }}>Doing</option>
            <option value="3" {{ $task->status == 3 ? 'selected' : '' }}>Review</option>
            <option value="4" {{ $task->status == 4 ? 'selected' : '' }}>Done</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="deadline" class="form-label">Deadline</label>
        <input type="date" name="deadline" id="deadline" class="form-control" value="{{ $task->deadline->format('Y-m-d') }}" required>
    </div>

    <button type="submit" class="btn btn-primary">Update Task</button>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
