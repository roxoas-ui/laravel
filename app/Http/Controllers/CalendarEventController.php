<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Illuminate\Http\Request;

class CalendarEventController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->query('from');
        $to = $request->query('to');

        $query = CalendarEvent::query();
        if ($from) $query->where('start_at', '>=', $from);
        if ($to) $query->where('end_at', '<=', $to);

        return $query->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'start_at' => 'required|date',
            'end_at' => 'nullable|date',
            'color' => 'nullable|string',
            'related_type' => 'nullable|string',
            'related_id' => 'nullable|integer',
            'reminder_days' => 'nullable|array',
        ]);

        $event = CalendarEvent::create($data);
        return response()->json($event, 201);
    }
}
