<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Alumni;

class BatchController extends Controller
{
    public function index(Request $request, $id = null)
    {
        if (!auth()->guard('alumni')->check()) {
            return redirect()->route('alumni.login');
        }

        $batches = Alumni::where('status', 'active')->where('id', '!=', auth()->guard('alumni')->user()->id)->distinct()->pluck('batch');

        $query = Alumni::where('status', 'active')->where('id', '!=', auth()->guard('alumni')->user()->id);
        
        $alumni = $query->orderBy('batch')->paginate(12);
        $groupedAlumni = $alumni->groupBy('batch');
        $alumniCount =  $alumni->total();

        return view('alumni.batch.index', compact('batches', 'groupedAlumni', 'alumni', 'alumniCount'));
    }


    public function fetchBatch(Request $request)
    {
        if ($request->ajax()) {
            return $this->loadBatch($request);
        }
        return view('alumni.index');
    }

    public function loadBatch(Request $request)
    {
        $query = Alumni::where('status', 'active')->where('id', '!=', auth()->guard('alumni')->user()->id);

        if ($request->batch) {
            $query->where('batch', $request->batch);
        }

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('fullname', 'like', '%' . $request->search . '%');
            });
        }
    
        $alumni = $query->orderBy('fullname')->paginate(12);
        $groupedAlumni = $alumni->groupBy('batch'); 
    
        return response()->json([
            'html' => view('alumni.batch.alumni_list', compact('alumni', 'groupedAlumni'))->render(),
            'pagination' => $alumni->links('pagination::bootstrap-4')->render(),
            'alumniCount' => $alumni->total()
        ]);
    }

    
}
