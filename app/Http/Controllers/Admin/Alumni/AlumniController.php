<?php

namespace App\Http\Controllers\Admin\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

use App\Models\Alumni;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        $courses = [
            'BSA' => 'BS in Accountancy',
            'BSBA' => 'BS in Business Administration',
            'BSHM' => 'BS in Hospitality Management',
            'BSCS' => 'BS in Computer Science',
            'BSIT' => 'BS in Information Technology'
        ];

        $alumni = Alumni::all();

        return view('admin.alumni.index', compact('alumni', 'courses'));
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

    public function saveOrUpdate(Request $request, $id = null)
    {
        $alumni = $id ? Alumni::findOrFail($id) : new Alumni;

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
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            if ($alumni->profile_picture && Storage::exists('public/' . $alumni->profile_picture)) {
                Storage::delete('public/' . $alumni->profile_picture);
            }

            $profilePath = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validatedData['profile_picture'] = $profilePath;
        }

        $alumni->fill($validatedData)->save();

        return response()->json([
            'message' => $id ? 'Updated successfully' : 'Created successfully',
            'data' => $alumni
        ]);
    }

}
