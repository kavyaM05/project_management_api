<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return auth()->user();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate(['title' => 'required', 'description' => 'required']);
        $project = auth()->user()->projects()->create($data);
        return response()->json($project);
    }
    public function update(Request $request){

    }
}
