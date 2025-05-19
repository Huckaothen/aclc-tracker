<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        $users = User::where('id', '!=', 1)->where('id', '!=', auth()->user()->id)->get();

        return view('admin.user.index', compact('users'));
    }

    public function saveUser(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'status' => 'required|in:active,inactive',
        ]);

        if ($request->id) {
            $user = User::find($request->id);

            if ($user) {
                $user->update($validated);
                return response()->json(['status' => 'success', 'message' => 'User updated successfully!']);
            }

            return response()->json(['status' => 'error', 'message' => 'User not found!'], 404);
        }

        User::create($validated);
        return response()->json(['status' => 'success', 'message' => 'User created successfully!']);
    }

    public function show(User $user)
    {
        return response()->json([
            'success' => true,
            'user' => $user
        ]);
    }
}
