<?php

namespace App\Http\Controllers\Admin\Career;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\JobStatusUpdated;
use Illuminate\Support\Facades\Mail;

use App\Models\AlumniJob;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        $jobs = AlumniJob::with('alumni')->orderBy('created_at', 'desc')->get();
        return view('admin.career.index', compact('jobs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company_name'   => 'required|string|max:255',
            'position'       => 'required|string|max:255',
            'salary'         => 'nullable|numeric|min:0',
            'company_site'   => 'nullable|url|max:255',
            'start_date'     => 'required|date',
            'end_date'       => 'nullable|date|after_or_equal:start_date',
            'status'         => 'required|in:pending,approved,rejected,draft,closed',
            'job_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $job = AlumniJob::updateOrCreate(
            ['id' => $request->id],
            [
                'alumni_id'           => $request->alumni_id,
                'user_id'             => auth()->user()->id,
                'category'            => $request->category,
                'position'            => $request->position,
                'company_name'        => $request->company_name,
                'company_site'        => $request->company_site,
                'location'            => $request->location,
                'office_address'      => $request->office_address,
                'company_established' => $request->company_established,
                'company_size'        => $request->company_size,
                'is_featured'         => $request->is_featured ?? false,
                'start_date'          => $request->start_date,
                'end_date'            => $request->end_date,
                'job_description'     => $request->job_description,
                'google_map'          => $request->google_map,
                'salary'              => $request->salary,
                'experience_level'    => $request->experience_level,
                'qualification'       => $request->qualification,
                'status'              => $request->status,
            ]
        );
        

        $msg = ($request->id ? 'updated': 'saved');
        return response()->json(['success' => true, 'message' => ('Job '.$msg.' successfully!')]);
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:alumni_jobs,id',
            'status' => 'required|in:pending,approved,rejected,draft,closed',
        ]);

        $job = AlumniJob::with('alumni')->findOrFail($request->id);
        $job->status = $request->status;
        $job->save();

        if ($job->alumni && $job->alumni->email && $request->status == 'approved') {
            Mail::to($job->alumni->email)->send(new JobStatusUpdated($job));
        }
        $msg = ($job->alumni && $job->alumni->email && $request->status == 'approved') ? ' and email sent!' : '.';
        return response()->json(['success' => true, 'message' => 'Job status updated' .$msg]);
    }

    public function show($id)
    {
        $job = AlumniJob::find($id);

        if (!$job) {
            return response()->json(['success' => false, 'message' => 'Job not found!'], 404);
        }

        return response()->json(['success' => true, 'job' => $job]);
    }
}
