<?php

namespace App\Http\Controllers;
use App\Models\LostItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        return view('LostPage.form', compact('user'));
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
            'claim_status' => 'required|string|in:claimed,unclaimed',
            'claimed_at' => 'nullable|date',
        ]);

        $lostData = $request->only([
            'itemname',
            'description',
            'lost_date',
            'image',
            'location',
            'lost_name',
            'lost_contact',
            'claim_status',
            'claimed_at'
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('lost_items', 'public');
            $lostData['image'] = $imagePath;
        }

        $userId = Auth::id();
        $lostData['userid'] = $userId;

        LostItem::create($lostData);

        return redirect()->route('lost-items.index')->with('success', 'Lost item reported successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lostItem = LostItem::findOrFail($id);
        return view('LostPage.lostdetails', compact('lostItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $lostItem = LostItem::findOrFail($id);
        $user = Auth::user();
        return view('LostPage.form', compact('lostItem', 'user'));
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
            'claim_status' => 'required|string|in:claimed,unclaimed',
            'claimed_at' => 'nullable|date',
        ]);

        $lostItem = LostItem::findOrFail($id);

        $imagePath = $lostItem->image; // Keep existing image by default
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('lost_items', 'public');
        }

        $lostItem->update([
            'itemname' => $request->itemname,
            'description' => $request->description,
            'lost_date' => $request->lost_date,
            'location' => $request->location,
            'image' => $imagePath,
            'lost_name' => $request->lost_name,
            'lost_contact' => $request->lost_contact,
            'claim_status' => $request->claim_status,
            'claimed_at' => $request->claimed_at,
        ]);

        return redirect()->route('lost-items.index')->with('success', 'Lost item updated successfully.');
    }

    public function destroy($id)
    {
        $item = LostItem::findOrFail($id);

        if (Auth::id() !== $item->userid) {
            abort(403, 'Unauthorized action');
        }

        if ($item->image) {
            Storage::delete('/storage/' . $item->image);
        }

        $item->delete();

        return redirect()->route('lost-items.index')->with('success', 'Item deleted successfully');
    }
}