<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        return response()->json(Project::where('user_id', Auth::id())->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
        ]);

        return response()->json($project, 201);
    }

    public function show($id)
    {
        $project = Project::where('user_id', Auth::id())->find($id);
        if (!$project) return response()->json(['error' => 'Project not found'], 404);
        return response()->json($project, 200);
    }

    public function update(Request $request, $id)
    {
        $project = Project::where('user_id', Auth::id())->find($id);
        if (!$project) return response()->json(['error' => 'Project not found'], 404);

        $project->update($request->only('title', 'description'));
        return response()->json($project, 200);
    }

    public function destroy($id)
    {
        $project = Project::where('user_id', Auth::id())->find($id);
        if (!$project) return response()->json(['error' => 'Project not found'], 404);

        $project->delete();
        return response()->json(['message' => 'Project deleted successfully'], 200);
    }
}
