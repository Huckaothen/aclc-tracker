<?php

namespace App\Http\Controllers\Admin\Announcement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        $announcements = Announcement::all();
        return view('admin.announcement.index', compact('announcements'));
    }

    public function saveAnnouncement(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'date_announce' => 'required|date',
            'status' => 'required|in:pending,approved,rejected,published',
        ]);

        if ($request->id) {
            $announcement = Announcement::find($request->id);

            if ($announcement) {
                $announcement->update($validated);
                return response()->json(['status' => 'success', 'message' => 'Announcement updated successfully!']);
            }

            return response()->json(['status' => 'error', 'message' => 'Announcement not found!'], 404);
        }

        Announcement::create($validated);
        return response()->json(['status' => 'success', 'message' => 'Announcement created successfully!']);
    }

    public function show(Announcement $announcement)
    {
        return response()->json([
            'success' => true,
            'announcement' => $announcement
        ]);
    }
}
