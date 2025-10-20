<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;

class ProjectController extends Controller
{
    public function index()
    {
        return Project::with('client')->paginate(15);
    }

    public function store(StoreProjectRequest $request)
    {
        $project = Project::create($request->validated());
        return response()->json($project, 201);
    }
}
