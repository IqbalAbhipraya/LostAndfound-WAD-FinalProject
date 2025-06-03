<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RetrunReportResource;
use App\Models\ReturnReport;
use Illuminate\Http\Request;

class ReturnReportApiController extends Controller
{
    //
    public function index()
    {
        $reports = ReturnReport::latest()->paginate(5);

        return new RetrunReportResource(true, 'All Return Report', $reports);
    }
}
