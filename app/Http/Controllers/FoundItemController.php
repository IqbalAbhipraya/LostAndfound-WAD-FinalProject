<?php

namespace App\Http\Controllers;
use App\Models\FoundItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        return view('FoundPage.form', compact('user'));
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

        $foundData = $request->only([
            'itemname',
            'description',
            'found_date',
            'image',
            'location',
            'founder_name',
            'founder_contact'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('found_items', 'public');
            $foundData['image'] = $imagePath;
        }

        $founderId = Auth::id();
        $foundData['founderid'] = $founderId;

        FoundItem::create($foundData);

        return redirect()->route('found.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $foundItem = FoundItem::findOrFail($id);
        return view('FoundPage.founddetails', compact('foundItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $foundItem = FoundItem::findOrFail($id);
        $user = Auth::user();
        return view('FoundPage.form', compact('foundItem', 'user'));
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

        $imagePath = $foundItem->image; // Keep existing image by default
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('found_items', 'public');
        }


        $foundItem->update([
            'itemname' => $request->itemname,
            'description' => $request->description,
            'found_date' => $request->found_date,
            'location' => $request->location,
            'image' => $imagePath,
            'founder_name' => $request->founder_name,
            'founder_contact' => $request->founder_contact,
        ]);

        return redirect()->route('found.index')->with('success', 'Found item updated successfully.');
    }


    public function destroy($id)
    {
        $item = FoundItem::findOrFail($id);

        if (Auth::id() !== $item->founderid && Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized action');
        }

        if ($item->image) {
            Storage::delete('/storage/' . $item->image);
        }

        $item->delete();

        return redirect()->route('found.index')->with('success', 'Item deleted successfully');
    }



}
