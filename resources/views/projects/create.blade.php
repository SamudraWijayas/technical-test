@extends('layouts.app')

@section('content')
<h1>Create Project</h1>
<form action="{{ route('projects.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Start Date</label>
        <input type="date" name="start_date" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>End Date</label>
        <input type="date" name="end_date" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="1">Planning</option>
            <option value="2">On Progress</option>
            <option value="3">Done</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
