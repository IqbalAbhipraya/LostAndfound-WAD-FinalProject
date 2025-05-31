<?php

namespace App\Http\Controllers;

use App\Models\ReturnReport;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class ReturnReportController extends Controller
{
    //
    public function index() {
        $articles = ReturnReport::latest()->get();
        return view('admin.index', compact('articles'));
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

    }

    public function destroy(ReturnReport $returnReport) {

    }

    public function show($id) {

    }
}
