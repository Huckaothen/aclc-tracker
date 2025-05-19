<?php

namespace App\Http\Controllers\Admin\Event;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;

class EventController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        $events = Event::all();
        return view('admin.event.index', compact('events'));
    }

    public function saveEvent(Request $request)
    {
        $validated = $request->validate([
            'event_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'backgroundColor' => 'required|string|max:255',
            'borderColor' => 'required|string|max:255',
            'status' => 'required|in:active,inactive'
        ]);

        if ($request->id) {
            $event = Event::find($request->id);

            if ($event) {
                $event->update($validated);
                return response()->json(['status' => 'success', 'message' => 'Event updated successfully!']);
            }

            return response()->json(['status' => 'error', 'message' => 'Event not found!'], 404);
        }

        Event::create($validated);
        return response()->json(['status' => 'success', 'message' => 'Event created successfully!']);
    }


    public function show(Event $event)
    {
        return response()->json([
            'success' => true,
            'event' => $event
        ]);
    }

}
