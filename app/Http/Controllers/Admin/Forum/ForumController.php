<?php

namespace App\Http\Controllers\Admin\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Forum;

class ForumController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        $forums = Forum::all();

        return view('admin.forum.index', compact('forums'));
    }

    public function saveForum(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,published',
        ]);

        if ($request->id) {
            $forum = Forum::find($request->id);

            if ($forum) {
                $forum->update($validated);
                return response()->json(['status' => 'success', 'message' => 'Forum updated successfully!']);
            }

            return response()->json(['status' => 'error', 'message' => 'Forum not found!'], 404);
        }

        Forum::create($validated);
        return response()->json(['status' => 'success', 'message' => 'Forum created successfully!']);
    }

    public function show(Forum $forum)
    {
        return response()->json([
            'success' => true,
            'forum' => $forum
        ]);
    }
}
