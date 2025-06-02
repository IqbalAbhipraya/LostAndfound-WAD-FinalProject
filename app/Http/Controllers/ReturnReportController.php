<?php

namespace App\Http\Controllers;

use App\Models\ReturnReport;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Auth;
use App\Models\FoundItem;

class ReturnReportController extends Controller
{
    //
    public function index() {
        $reports = ReturnReport::latest()->get();
        return view('returnReport.report-view', compact('reports'));
    }

    public function create($id) {
        $foundItemId = FoundItem::findOrFail($id);
        return view('returnReport.report-form', compact('foundItemId'));
    }

    public function store(Request $request, $id) {
        $request->validate([
            'owner_name' => 'required',
            'condition' => 'required',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $reportData = $request->only('owner_name', 'condition');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('return_report', 'public');
            $reportData['image'] = $imagePath;
        }

        if (!FoundItem::find($id)) {
            return back()->with('error', 'Lost item not found.')->withInput();
        }

        $founderId = Auth::id();
        $reportData['founder_id'] = $founderId;

        $reportData['found_item_id'] = $id;

        ReturnReport::create($reportData);

        session()->flash('success', 'Article successfully created!');
        return redirect()->route('return.index');
    }

    public function edit() {
        return view('admin.editReport', compact('article'));
    }

    public function update(Request $request) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    public function destroy(ReturnReport $returnReport) {
        $returnReport->delete();
        session()->flash('success', 'Article successfully deleted!');
        return redirect()->route('admin.index');
    }

    public function show($id) {

    }
}
