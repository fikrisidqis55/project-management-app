<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    public function index()
    {
        return Milestone::with('project')->get();
    }

    public function store(Request $request)
    {
        $milestone = Milestone::create($request->all());
        return response()->json($milestone, 201);
    }

    public function update(Request $request, Milestone $milestone)
    {
        $milestone->update($request->all());
        return response()->json($milestone);
    }

    public function destroy(Milestone $milestone)
    {
        $milestone->delete();
        return response()->json(null, 204);
    }
}
