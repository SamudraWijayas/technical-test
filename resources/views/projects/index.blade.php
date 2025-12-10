@extends('layouts.app')

@section('content')
<h1>Projects</h1>
<a href="{{ route('projects.create') }}" class="btn btn-primary mb-3">Add Project</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Status</th>
            <th>Tasks</th>
            <th>Progress</th>
            <th>Problematic</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
        <tr>
            <td>{{ $project->name }}</td>
            <td>{{ $project->status_label }}</td>
            <td>
                Total: {{ $project->task_count }} <br>
                @foreach($project->task_summary as $status => $count)
                    Status {{ $status }}: {{ $count }} <br>
                @endforeach
            </td>
            <td>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{ $project->progress_percent }}%;" aria-valuenow="{{ $project->progress_percent }}" aria-valuemin="0" aria-valuemax="100">
                        {{ $project->progress_percent }}%
                    </div>
                </div>
            </td>
            <td>
                @if($project->is_problematic)
                    <span class="badge bg-danger">Yes</span>
                @else
                    <span class="badge bg-success">No</span>
                @endif
            </td>
            <td>
                <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete project?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
