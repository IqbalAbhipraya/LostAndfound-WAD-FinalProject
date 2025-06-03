<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LostItemResource;
use App\Models\LostItem;

class LostApiController extends Controller
{
    public function indexApi()
    {
        $lostItems = LostItem::latest()->paginate(5);

        return new LostItemResource(true, 'All Lost Items', $lostItems);
    }
}