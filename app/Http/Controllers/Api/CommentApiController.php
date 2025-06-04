<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentApiController extends Controller
{
    public function indexApi()
    {
        $commentt = Comment::latest()->paginate(5);

        return new CommentResource( true, 'All Found Items', $commentt);
    }
}
