<?php

namespace App\Http\Controllers;
use App\Models\LostItem;
use Illuminate\Http\Request;

class LostItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lostItems = LostItem::orderBy('lost_date')->get();
        return view('LostPage.lostitems', compact('lostItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('LostPage.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'itemname' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'lost_date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'lost_name' => 'required|string|max:255',
            'lost_contact' => 'required|string|max:255',
        ]);

        $lostItem = LostItem::create($request->except('image'));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('lost_items', 'public');
            $lostItem->image = $imagePath;
            $lostItem->save();
        }

        return redirect()->route('lost-items.index')->with('success', 'Lost item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lostItem = LostItem::findOrFail($id);
        return view('LostPage.lostitems', compact('lostItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lostItem = LostItem::findOrFail($id);
        return view('LostPage.form', compact('lostItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'itemname' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'lost_date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'lost_name' => 'required|string|max:255',
            'lost_contact' => 'required|string|max:255',
        ]);

        $lostItem = LostItem::findOrFail($id);
        $lostItem->update($request->except('image'));

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('lost_items', 'public');
            $lostItem->image = $imagePath;
            $lostItem->save();
        }

        return redirect()->route('lost-items.index')->with('success', 'Lost item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $lostItem = LostItem::findOrFail($id);
        $lostItem->delete();

        return redirect()->route('lost-items.index')->with('success', 'Lost item deleted successfully.');
    }
}