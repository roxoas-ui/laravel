<?php

namespace App\Http\Controllers;

use App\Models\CalendarEvent;
use Illuminate\Http\Response;

class IcalController extends Controller
{
    public function export()
    {
        $events = CalendarEvent::all();

        $lines = [];
        $lines[] = 'BEGIN:VCALENDAR';
        $lines[] = 'VERSION:2.0';
        $lines[] = 'PRODID:-//Novo Controle de Licenças//EN';

        foreach ($events as $e) {
            $lines[] = 'BEGIN:VEVENT';
            $lines[] = 'UID:'.$e->id;
            $lines[] = 'DTSTAMP:'.now()->format('Ymd\THis\Z');
            $lines[] = 'DTSTART:'.$e->start_at->format('Ymd\THis\Z');
            if ($e->end_at) $lines[] = 'DTEND:'.$e->end_at->format('Ymd\THis\Z');
            $lines[] = 'SUMMARY:'.addslashes($e->title);
            $lines[] = 'END:VEVENT';
        }

        $lines[] = 'END:VCALENDAR';

        $content = implode("\r\n", $lines);
        return new Response($content, 200, [
            'Content-Type' => 'text/calendar; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="events.ics"'
        ]);
    }
}
