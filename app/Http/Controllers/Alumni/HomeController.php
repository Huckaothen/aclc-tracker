<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\AlumniJob;
use App\Models\Alumni;
use App\Models\Announcement;
use App\Models\Event;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Check if the alumni is logged in
        if (!Auth::guard('alumni')->check()) {
            return redirect()->route('alumni.login');
        }

        // Fetch latest 5 approved job postings
        $jobs = AlumniJob::where('status', 'approved')
            ->where('is_featured', '1')
            ->orderBy('created_at', 'desc')
            ->take(2) // Show the latest 5 job posts
            ->get();

        $jobs_count = AlumniJob::where('status', 'approved')->count();

        // Get total alumni count
        $totalAlumni = Alumni::count();

        // Get active alumni count
        $activeUsers = Alumni::where('status', 'active')->count();

        // Fetch upcoming events
        $events = Event::where('status', 'active')->take(2)->get();
        $events_count = Event::where('status', 'active')->count();

        // Get active announcements
        $announcements = Announcement::where('status', 'published')->take(2)->get();

        // Engagement chart data (you can update this with real dynamic data if needed)
        $alumniPerYear = Alumni::where('status', 'active')
            ->selectRaw('YEAR(created_at) as year, count(*) as count')
            ->groupBy('year')
            ->orderBy('year')
            ->get();


        $chartLabels = [];
        $chartData = [];

        foreach ($alumniPerYear as $data) {
            $chartLabels[] = (string) $data->year; 
            $chartData[] = (int) $data->count;    
        }


        return view('alumni.home.index', compact(
            'announcements',
            'jobs',
            'events',
            'chartLabels',
            'chartData',
            'totalAlumni',
            'activeUsers',
            'events_count',
            'jobs_count'
        ));
    }
}
