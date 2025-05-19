<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Models\Event;

class EventsController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::guard('alumni')->check()) {
            return redirect()->route('alumni.login');
        }

        return view('alumni.events.index');
    }

    public function getEvents(Request $request)
    {
        $startDate = $request->query('start');
        $endDate = $request->query('end');

        if ($startDate && $endDate) {
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();

            $events = Event::whereBetween('start_date', [$startDate, $endDate])
                           ->orWhereBetween('end_date', [$startDate, $endDate])
                           ->where('status', 'active')
                           ->get();
        } else {
            $events = Event::where('status', 'active')->get();
        }

        $formattedEvents = $events->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->event_name,
                'start' => $event->start_date,
                'end' => $event->end_date ? Carbon::parse($event->end_date)->addDay()->toDateString() : null,
                'description' => $event->description,
                'borderColor' => $event->borderColor ?? '#3a87ad',
                'backgroundColor' => $event->backgroundColor ?? '#3a87ad'
            ];
        });

        return response()->json($formattedEvents);
    }

}
