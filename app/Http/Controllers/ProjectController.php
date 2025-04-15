<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $projects = Project::where('user_id', Auth::id())->get();
        return response()->json($projects);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $project = Project::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => Auth::id(),
        ]);

        return response()->json(['message' => 'Project created', 'project' => $project], 201);
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $project = Project::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $project->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json(['message' => 'Project updated', 'project' => $project]);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $project = Project::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $project->delete();

        return response()->json(['message' => 'Project deleted']);
    }
}
