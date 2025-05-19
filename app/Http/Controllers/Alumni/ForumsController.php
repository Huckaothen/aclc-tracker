<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Forum;

class ForumsController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->guard('alumni')->check()) {
            return redirect()->route('alumni.login');
        }

        // $forums = Forum::where('status', 'published')
        // ->orderBy('created_at', 'desc')
        // ->get();

        return view('alumni.forums.index');
    }

    public function fetchForums(Request $request)
    {
        $query = Forum::where('status', 'published');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        $forums = $query->orderBy('created_at', 'desc')->paginate(5);

        $groupedForums = collect($forums->items())->groupBy(function ($forum) {
            return \Carbon\Carbon::parse($forum->created_at)->format('l, F d, Y');
        });

        return response()->json([
            'html' => view('alumni.forums.forums_list', compact('groupedForums', 'forums'))->render(),
            'forumCount' => $forums->total()
        ]);
    }

    public function show($id)
    {
        if (!auth()->guard('alumni')->check()) {
            return redirect()->route('alumni.login');
        }
        
        $forum = Forum::findOrFail($id);
        return view('alumni.forums.forum_details', compact('forum'));
    }
}
