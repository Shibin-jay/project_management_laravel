<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function generateReport($id)
    {
        $project = Project::where('user_id', Auth::id())->with(['tasks.remarks'])->find($id);
        if (!$project) return response()->json(['error' => 'Project not found'], 404);

        return response()->json([
            'project' => $project,

        ], 200);
    }
}
