<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FoundItemResource;
use App\Models\FoundItem;

class FoundItemApiController extends Controller
{
    public function indexApi()
    {
        $foundItems = FoundItem::latest()->paginate(5);

        return new FoundItemResource( true, 'All Found Items', $foundItems);
    }
}
