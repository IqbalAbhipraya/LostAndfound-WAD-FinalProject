<?php

namespace App\Http\Controllers;
use App\Models\FoundItem;
use Illuminate\Http\Request;

class FoundItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foundItems = FoundItem::orderBy('found_date')->get();
        return view('FoundPage.founditems', compact('foundItems'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('FoundPage.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'itemname' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'found_date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            'founder_name' => 'required|string|max:255',
            'founder_contact' => 'required|string|max:255',
        ]);

        $foundItem = FoundItem::create($request->all());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('found_items', 'public');
            $foundItem['image'] = $imagePath;
            $foundItem->save();
        }

        return redirect()->route('founditems.index')->with('success', 'Found item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $foundItem = FoundItem::findOrFail($id);
        return view('FoundPage.founditems', compact('foundItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $foundItem = FoundItem::findOrFail($id);
        return view('FoundPage.form', compact('foundItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'itemname' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'found_date' => 'required|date',
            'location' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'founder_name' => 'required|string|max:255',
            'founder_contact' => 'required|string|max:255',
        ]);

        $foundItem = FoundItem::findOrFail($id);
        $foundItem->update($request->all());

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('found_items', 'public');
            $foundItem->image = $imagePath;
            $foundItem->save();
        }

        return redirect()->route('FoundPage.founditems')->with('success', 'Found item updated successfully.');
    }


    public function destroy(string $id)
    {
        $foundItem = FoundItem::findOrFail($id);
        $foundItem->delete();

        return redirect()->route('FoundPage.founditems')->with('success', 'Found item deleted successfully.');

    }
}
