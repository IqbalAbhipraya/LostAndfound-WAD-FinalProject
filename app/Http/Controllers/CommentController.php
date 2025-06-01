<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\LostItem; 
use App\Models\FoundItem; 

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comments' => 'required|string|max:1000', 
            'item_id' => 'required|integer',          
            'item_type' => 'required|in:lost,found',  
        ]);

        $comment = new Comment();
        $comment->commenter_id = Auth::id(); 
        $comment->comments = $request->comments; 

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

        $comment->save();

        if ($request->item_type === 'lost') {
            return redirect()->route('lost-items.show', $request->item_id)->with('Success', 'Comment successfully added!');
        } else { 
            return redirect()->route('found.show', $request->item_id)->with('Success', 'Comment successfully added!');
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

        $redirectItemId = $comment->lost_items_id ?? $comment->found_items_id;
        $redirectRouteName = '';
        if ($comment->lost_items_id) {
            $redirectRouteName = 'lost-items.show';
        } elseif ($comment->found_items_id) {
            $redirectRouteName = 'found.show';
        }

        $comment->delete(); 

        if ($redirectRouteName && $redirectItemId) {
             return redirect()->route($redirectRouteName, $redirectItemId)->with('Success', 'Comment successfully deleted.');
        }
        return back()->with('Success', 'Comment successfully deleted.'); 
    }
}