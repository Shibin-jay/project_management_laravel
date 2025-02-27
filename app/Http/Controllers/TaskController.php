<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index($project_id)
    {
        $project = Project::where('user_id', Auth::id())->find($project_id);
        if (!$project) return response()->json(['error' => 'Project not found'], 404);

        return response()->json($project->tasks, 200);
    }

    public function store(Request $request, $project_id)
    {
        $project = Project::where('user_id', Auth::id())->find($project_id);
        if (!$project) return response()->json(['error' => 'Project not found'], 404);

        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|string|in:Pending,In Progress,Completed'
        ]);

        $task = Task::create([
            'title' => $request->title,
            'status' => $request->status,
            'project_id' => $project_id
        ]);

        return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        $task = Task::whereHas('project', function ($query) {
            $query->where('user_id', Auth::id());
        })->find($id);

        if (!$task) return response()->json(['error' => 'Task not found'], 404);

        $task->update($request->only('title', 'status'));
        return response()->json($task, 200);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:Pending,In Progress,Completed',
            'remark' => 'nullable|string'
        ]);

        $task = Task::whereHas('project', function ($query) {
            $query->where('user_id', Auth::id());
        })->find($id);

        if (!$task) return response()->json(['error' => 'Task not found'], 404);

        $task->update(['status' => $request->status]);

        if ($request->remark) {
            $task->remarks()->create([
                'text' => $request->remark
            ]);
        }

        return response()->json(['message' => 'Task status updated successfully'], 200);
    }

    public function destroy($id)
    {
        $task = Task::whereHas('project', function ($query) {
            $query->where('user_id', Auth::id());
        })->find($id);

        if (!$task) return response()->json(['error' => 'Task not found'], 404);

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully'], 200);
    }
}
