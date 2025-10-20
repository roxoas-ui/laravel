<?php

namespace App\Http\Controllers;

use App\Models\Conditional;
use Illuminate\Http\Request;

class ConditionalController extends Controller
{
    public function index()
    {
        return Conditional::with('license')->paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'license_id' => 'required|exists:licenses,id',
            'description' => 'required|string',
            'due_date' => 'nullable|date',
            'frequency' => 'nullable|string',
        ]);

        $conditional = Conditional::create($data);
        return response()->json($conditional, 201);
    }
}
