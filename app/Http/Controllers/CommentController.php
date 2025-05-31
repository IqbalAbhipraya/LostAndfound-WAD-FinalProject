<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Untuk mendapatkan user yang sedang login
use App\Models\LostItem; // Import model LostItem
use App\Models\FoundItem; // Import model FoundItem

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comments' => 'required|string|max:1000', // Isi komentar
            'item_id' => 'required|integer',           // ID dari item yang dikomentari
            'item_type' => 'required|in:lost,found',   // Tipe item: 'lost' atau 'found'
        ]);

        $comment = new Comment();
        $comment->commenter_id = Auth::id(); // User yang sedang login sebagai pengirim komentar
        $comment->comments = $request->comments; // Isi komentar dari form

        // Tentukan foreign key mana yang akan diisi berdasarkan item_type
        if ($request->item_type === 'lost') {
            if (!LostItem::find($request->item_id)) {
                return back()->with('error', 'Lost item not found.')->withInput();
            }
            $comment->lost_items_id = $request->item_id;
            $comment->found_items_id = null; 
        } elseif ($request->item_type === 'found') {
            if (!FoundItem::find($request->item_id)) {
                return back()->with('error', 'Found item not found.')->withInput();
            }
            $comment->found_items_id = $request->item_id;
            $comment->lost_items_id = null; 
        } else {
            return back()->with('error', 'Invalid item type.')->withInput();
        }

        // Simpan komentar ke database
        $comment->save();

        // Redirect kembali ke halaman detail item yang relevan
        if ($request->item_type === 'lost') {
            return redirect()->route('lost-items.show', $request->item_id)->with('Success', 'Comment successfully added!');
        } else { // item_type === 'found'
            return redirect()->route('found-items.show', $request->item_id)->with('Success', 'Comment successfully added!');
        }
    }


    public function edit(Comment $comment)
    {
        if (Auth::id() !== $comment->commenter_id && (!Auth::user() || Auth::user()->user_type !== 'admin')) {
            abort(403, 'You do not have permission to edit this comment.');
        }


        return view('comments.edit', compact('comment'));
    }


    public function update(Request $request, Comment $comment)
    {
        if (Auth::id() !== $comment->commenter_id && (!Auth::user() || Auth::user()->user_type !== 'admin')) {
            abort(403, 'You do not have permission to update this comment.');
        }

        $request->validate([
            'comments' => 'required|string|max:1000',
        ]);

        $comment->comments = $request->comments; 
        $comment->save();

        // Redirect kembali ke halaman detail item terkait
        if ($comment->lost_items_id) {
            return redirect()->route('lost-items.show', $comment->lost_items_id)->with('Success', 'Comment updated successfully!');
        } elseif ($comment->found_items_id) {
            return redirect()->route('found-items.show', $comment->found_items_id)->with('Success', 'Comment updated successfully!');
        }

        return back()->with('Success', 'Comment successfully updated!');
    }


    public function destroy(Comment $comment)
    {
        if (Auth::id() !== $comment->commenter_id && (!Auth::user() || Auth::user()->user_type !== 'admin')) {
            abort(403, 'You do not have permission to delete this comment.');
        }

        // Ambil ID item terkait sebelum dihapus untuk redirect
        $redirectItemId = $comment->lost_items_id ?? $comment->found_items_id;
        $redirectRouteName = '';
        if ($comment->lost_items_id) {
            $redirectRouteName = 'lost-items.show';
        } elseif ($comment->found_items_id) {
            $redirectRouteName = 'found-items.show';
        }

        $comment->delete(); 

        // Redirect kembali ke halaman detail item terkait
        if ($redirectRouteName && $redirectItemId) {
             return redirect()->route($redirectRouteName, $redirectItemId)->with('Success', 'Comment successfully deleted.');
        }
        return back()->with('Success', 'Comment successfully deleted.'); 
    }
}