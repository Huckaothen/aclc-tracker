<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Announcement;

class AnnouncementsController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->guard('alumni')->check()) {
            return redirect()->route('alumni.login');
        }

        $announcements = Announcement::where('status', 'published')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('alumni.announcements.index', compact('announcements'));
    }
}
