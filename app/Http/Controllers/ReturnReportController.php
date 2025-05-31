<?php

namespace App\Http\Controllers;

use App\Models\ReturnReport;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ReturnReportController extends Controller
{
    //
    public function index() {
        $reports = ReturnReport::latest()->get();
        return view('returnReport.report-view', compact('reports'));
    }

    public function create() {
        return view('admin.create');
    }

    public function store(Request $request) {
        $request->validate([
            'owner_name' => 'required',
            'condition' => 'required',
            'image'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $reportData = $request->only('owner_name', 'condition', 'image');

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('articles', 'public');
            $articleData['image'] = $imagePath;
        }

        auth()->user()->returnReport()->create($reportData);

        session()->flash('success', 'Article successfully created!');
        return redirect()->route('admin.index');
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
