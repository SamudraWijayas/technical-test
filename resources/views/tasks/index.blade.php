@extends('layouts.app')

@section('content')
<h1>Tasks</h1>
<a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Add Task</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Project</th>
            <th>Title</th>
            <th>Description</th>
            <th>Priority</th>
            <th>Status</th>
            <th>Deadline</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <tr>
            <td>{{ $task->project->name }}</td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>{{ $task->priority_label }}</td>
            <td>{{ $task->status_label }}</td>
            <td>{{ $task->deadline }}</td>
            <td>
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete task?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
