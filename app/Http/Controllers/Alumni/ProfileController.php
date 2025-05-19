<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Alumni;
use App\Models\AlumniJob;

class ProfileController extends Controller
{
    public function index(Request $request, $id = null)
    {
        if (!auth()->guard('alumni')->check()) {
            return redirect()->route('alumni.login');
        }

        $is_edit = (auth()->guard('alumni')->user()->id == ($id ?? auth()->guard('alumni')->user()->id));

        $alumni = $id ? Alumni::findOrFail($id) : auth()->guard('alumni')->user();

        $courses = [
            'BSA' => 'BS in Accountancy',
            'BSBA' => 'BS in Business Administration',
            'BSHM' => 'BS in Hospitality Management',
            'BSCS' => 'BS in Computer Science',
            'BSIT' => 'BS in Information Technology'
        ];

        return view('alumni.profile.index', compact('courses', 'alumni', 'is_edit'));
    }

    public function show($id)
    {
        $alumni = Alumni::findOrFail($id);
        
        return response()->json([
            "message" => "success",
            "data" => [
                'id' => $alumni->id,
                'email' => $alumni->email,
                'college_id' => $alumni->college_id,
                'fullname' => $alumni->fullname,
                'contact' => $alumni->contact,
                'dob' => $alumni->dob ? \Carbon\Carbon::parse($alumni->dob)->format('Y-m-d') : null,
                'address' => $alumni->address,
                'gender' => ucfirst($alumni->gender),
                'civil_status' => ucfirst($alumni->civil_status),
                'batch' => $alumni->batch,
                'graduated_course' => $alumni->graduated_course,
                'employability_status' => ucfirst(str_replace('_', ' ', $alumni->employability_status)),
                'company_name' => $alumni->company_name,
                'facebook_link' => $alumni->facebook_link,
                'twitter_link' => $alumni->twitter_link,
                'linkedin_link' => $alumni->linkedin_link,
                'github_link' => $alumni->github_link,
                'status' => ucfirst($alumni->status),
                'email_verified_at' => $alumni->email_verified_at ? \Carbon\Carbon::parse($alumni->email_verified_at)->format('Y-m-d H:i:s') : null,
                'created_at' => $alumni->created_at ? \Carbon\Carbon::parse($alumni->created_at)->format('Y-m-d H:i:s') : null,
                'updated_at' => $alumni->updated_at ? \Carbon\Carbon::parse($alumni->updated_at)->format('Y-m-d H:i:s') : null,
                "profile_picture" => $alumni->profile_picture ? asset('storage/' . $alumni->profile_picture) : asset('storage/profile_pictures/default.png'),
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $alumni = Alumni::where('id', $id)->firstOrFail();

        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('alumni')->ignore($alumni->id)],
            'college_id' => ['required', Rule::unique('alumni')->ignore($alumni->id)],
            'contact' => 'required|string|max:15',
            'dob' => 'nullable|date',
            'gender' => 'required|in:male,female',
            'civil_status' => 'required|in:single,married,widowed,divorced,separated,annulled',
            'batch' => 'required|integer|min:1900|max:' . date('Y'),
            'graduated_course' => 'required|string|max:255',
            'employability_status' => 'required|in:employed,self_employed,unemployed',
            'company_name' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive,banned',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facebook_link' => 'nullable|string|max:255',
            'twitter_link' => 'nullable|string|max:255',
            'linkedin_link' => 'nullable|string|max:255',
            'github_link' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($alumni->profile_picture && Storage::exists('public/' . $alumni->profile_picture)) {
                Storage::delete('public/' . $alumni->profile_picture);
            }


            $profilePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validatedData['profile_picture'] = $profilePath;
        }

        $alumni->update($validatedData);

        return response()->json(['message' => 'success', 'data' => $alumni]);
    }

    public function getJobs()
    {
        $jobs = AlumniJob::where('alumni_id', auth()->guard('alumni')->user()->id)->get();

        if ($jobs->isEmpty()) {
            return response()->json(['jobs' => [], 'message' => 'No jobs found'], 200);
        }

        return response()->json(['jobs' => $jobs]);
    }

    public function showJobs($id)
    {
        $job = AlumniJob::find($id);

        if (!$job) {
            return response()->json(['success' => false, 'message' => 'Job not found!'], 404);
        }

        return response()->json(['success' => true, 'job' => $job]);
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
            'job_description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $job = AlumniJob::updateOrCreate(
            ['id' => $request->id],
            [
                'alumni_id'           => auth()->guard('alumni')->user()->id,
                'user_id'             => null,
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
                'qualification'       => $request->qualification
            ]
        );
        

        $msg = ($request->id ? 'updated': 'saved');
        return response()->json(['success' => true, 'message' => ('Job '.$msg.' successfully!')]);
    }

}
