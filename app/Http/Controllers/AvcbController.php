<?php

namespace App\Http\Controllers;

use App\Models\Avcb;
use Illuminate\Http\Request;

class AvcbController extends Controller
{
    public function index()
    {
        return Avcb::with('project')->paginate(15);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_id' => 'required|exists:projects,id',
            'ppci_number' => 'required|string',
            'issued_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
            'has_compensatory_measures' => 'boolean',
        ]);

        $avcb = Avcb::create($data);
        return response()->json($avcb, 201);
    }
}
