<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Mail\VerifyEmail;

use App\Models\Alumni;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::guard('alumni')->check()) {
            return redirect()->route('alumni.home');
        }
        return view('alumni.login');
    }
    
    public function account(Request $request)
    {
        if (Auth::guard('alumni')->check()) {
            return redirect()->route('alumni.home');
        }

        $courses = [
            'BSA' => 'BS in Accountancy',
            'BSBA' => 'BS in Business Administration',
            'BSHM' => 'BS in Hospitality Management',
            'BSCS' => 'BS in Computer Science',
            'BSIT' => 'BS in Information Technology'
        ];

        return view('alumni.register', compact('courses'));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 400);
        }

        if (!Auth::guard('alumni')->attempt($request->only('email', 'password'))) {
            return response()->json(['success' => false, 'message' => 'Invalid email or password.'], 401);
        }

        $alumni = Auth::guard('alumni')->user();


        if (!$alumni->email_verified_at) {
            Auth::guard('alumni')->logout();
            return response()->json([
                'success' => false,
                'message' => 'Your email is not verified. Please check your email for the verification link.'
            ], 403);
        }

        if ($alumni->status != 'active') {
            Auth::guard('alumni')->logout();
            return response()->json([
                'success' => false,
                'message' => 'You are banned or inactive. Please contact the admin.'
            ], 403);
        }        

        $request->session()->regenerate();

        return response()->json([
            'success' => true,
            'message' => 'Login successful.',
        ], 200);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:alumni',
            'password' => 'required|min:6',
            'college_id' => 'required|unique:alumni',
            'fullname' => 'required',
            'contact' => ['required', 'regex:/^09\d{9}$/'],
            'dob' => 'nullable|date',
            'address' => 'nullable|string',
            'gender' => 'required|in:male,female',
            'batch' => 'required|integer',
            'graduated_course' => 'required',
            'company_name' => 'nullable',
            'profile_picture' => 'nullable|image',
        ]);

        $verification_token = Str::random(64);

        $alumni = Alumni::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'college_id' => $request->college_id,
            'fullname' => $request->fullname,
            'contact' => $request->contact,
            'dob' => $request->dob,
            'address' => $request->address,
            'gender' => $request->gender,
            'batch' => $request->batch,
            'graduated_course' => $request->graduated_course,
            'employability_status' => $request->employability_status,
            'company_name' => $request->company_name,
            'profile_picture' => $request->profile_picture ? $request->file('profile_picture')->store('profile_pictures', 'public') : null,
            'status' => 'inactive',
            'verification_token' => $verification_token,
        ]);

        $verificationLink = URL::temporarySignedRoute(
            'alumni.verify.email',
            now()->addMinutes(60),
            ['token' => $verification_token]
        );

        Mail::to($alumni->email)->send(new VerifyEmail($alumni, $verificationLink));

        return response()->json(['message' => 'Registration successful! Please check your email for verification.']);
    }


    public function verifyEmail($token)
    {
        $alumni = Alumni::where('verification_token', $token)->first();

        if (!$alumni) {
            return redirect()->route('alumni.login')->with('error', 'Invalid or expired verification link.');
        }

        $alumni->update([
            'email_verified_at' => now(),
            'status' => 'active',
            'verification_token' => null,
        ]);

        return redirect()->route('alumni.login')->with('success', 'Email verified successfully! You can now log in.');
    }

    public function logout(Request $request)
    {
        if (!auth()->guard('alumni')->check()) {
            return redirect()->route('alumni.login');
        }
        
        Auth::guard('alumni')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('alumni.login')->with('success', 'You have been logged out successfully.');
    }

}
