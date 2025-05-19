<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\AlumniJob;

class JobsController extends Controller
{
    public function index(Request $request)
    {
        if (!Auth::guard('alumni')->check()) {
            return redirect()->route('alumni.login');
        }

        return view('alumni.jobs.index');
    }

    public function fetchJobs(Request $request)
    {
        $query = AlumniJob::where('status', 'approved');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('position', 'like', '%' . $request->search . '%')
                ->orWhere('company_name', 'like', '%' . $request->search . '%')
                ->orWhere('category', 'like', '%' . $request->search . '%')
                ->orWhere('job_description', 'like', '%' . $request->search . '%');
            });
        }

        // Paginate results (5 jobs per page)
        $jobs = $query->orderBy('created_at', 'desc')->paginate(5);

        // Group paginated jobs by date
        $groupedJobs = collect($jobs->items())->groupBy(function ($job) {
            return \Carbon\Carbon::parse($job->created_at)->format('l, F d, Y');
        });

        return response()->json([
            'html' => view('alumni.jobs.jobs_list', compact('groupedJobs', 'jobs'))->render(),
            'jobCount' => $jobs->total()
        ]);

        // return view('alumni.jobs.jobs_list', compact('groupedJobs', 'jobs'))->render();
    }

    public function show($id)
    {
        if (!auth()->guard('alumni')->check()) {
            return redirect()->route('alumni.login');
        }
        
        $job = AlumniJob::findOrFail($id);
        return view('alumni.jobs.job_details', compact('job'));
    }
}
