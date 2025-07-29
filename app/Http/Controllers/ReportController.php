<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = (Gate::allows('ViewAll'))
            ? Report::all()
            : Report::where('user_id', Auth::id())->get();
        return view('reports.index', ['reports' => $reports, 'user_role' => Auth::user()->role]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('create')) {
            abort(403);
        }
        $request->validate([
            'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'user_id' => 'required|exists:users,id',
        ]);
        $report = new Report();
        $report->title = uniqid() . '_' . $request->file('file')->getClientOriginalName();
        $report->report_path = $request->file('file')->store('reports', 'public');
        $report->user_id = $request->user_id;
        $report->save();

        return redirect()->route('reports.index')
            ->with('success', 'Report created successfully!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        if (!Gate::allows('delete', $report)) {
            abort(403);
        }

        $report->delete();
        return redirect()->route('reports.index')
            ->with('success', 'Report deleted successfully!');
    }
}
