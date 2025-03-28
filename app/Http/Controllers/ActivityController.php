<?php
namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Child;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index($childId)
    {
        $child = Child::findOrFail($childId);
        $activities = ActivityLog::where('child_id', $childId)->orderBy('time', 'desc')->get();
        
        return view('activity.index', compact('child', 'activities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'child_id' => 'required|exists:children,id',
            'activity_type' => 'required|string',
            'description' => 'required|string',
            'time' => 'required|date',
            'status' => 'nullable|string',
        ]);

        ActivityLog::create($request->all());

        return redirect()->back()->with('success', 'Aktivitas berhasil dicatat.');
    }
}

