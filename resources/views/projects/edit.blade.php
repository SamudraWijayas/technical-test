@extends('layouts.app')

@section('content')
<h1>Edit Project</h1>

<form action="{{ route('projects.update', $project) }}" method="POST">
    @csrf
    @method('PUT') {{-- Ini wajib untuk method PUT --}}
    
    <div class="mb-3">
        <label for="name" class="form-label">Project Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $project->name }}" required>
    </div>

    <div class="mb-3">
        <label for="start_date" class="form-label">Start Date</label>
        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $project->start_date->format('Y-m-d') }}" required>
    </div>

    <div class="mb-3">
        <label for="end_date" class="form-label">End Date</label>
        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $project->end_date->format('Y-m-d') }}" required>
    </div>

    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" required>
            <option value="1" {{ $project->status == 1 ? 'selected' : '' }}>Planning</option>
            <option value="2" {{ $project->status == 2 ? 'selected' : '' }}>On Progress</option>
            <option value="3" {{ $project->status == 3 ? 'selected' : '' }}>Done</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Update Project</button>
    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
