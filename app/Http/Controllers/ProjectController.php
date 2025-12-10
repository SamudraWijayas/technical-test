<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('tasks')->get();

        $projects->map(function($project){
            $project->task_count = $project->taskCount();
            $project->task_summary = $project->taskSummaryByStatus();
            $project->progress_percent = $project->progress();
            $project->is_problematic = $project->isProblematic();
        });

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|integer|between:1,3',
        ]);

        Project::create($validated);
        return redirect()->route('projects.index')->with('success', 'Project created!');
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'status' => 'required|integer|between:1,3',
        ]);

        $project->update($validated);
        return redirect()->route('projects.index')->with('success', 'Project updated!');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted!');
    }
}
