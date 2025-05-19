<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alumni;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        // Total Alumni
        $totalAlumni = Alumni::count();

        // Active Users (example: those who logged in last 30 days)
        $activeUsers = Alumni::where('status', 'active')->count();

        // Employed Alumni
        $employedAlumni = Alumni::where('employability_status', 'employed')->count();

        // Self-Employed
        $selfEmployed = Alumni::where('employability_status', 'self-employed')->count();

        // Unemployed
        $unemployed = Alumni::where('employability_status', 'unemployed')->count();

        // Recently Graduated (within last 12 months)
        $recentlyGraduated = Alumni::where('batch', '>=', now()->year - 1)->count();

        // Alumni Registration Trend (last 7 months)
        $registrationTrends = Alumni::selectRaw("DATE_FORMAT(created_at, '%b') as month, COUNT(*) as total")
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderByRaw("MIN(created_at)")
            ->pluck('total', 'month');

        // Latest Registered Alumni (limit 5)
        $latestAlumni = Alumni::latest()->limit(5)->get();

        return view('admin.dashboard.index', compact(
            'totalAlumni',
            'activeUsers',
            'employedAlumni',
            'selfEmployed',
            'unemployed',
            'recentlyGraduated',
            'registrationTrends',
            'latestAlumni'
        ));
    }
}
