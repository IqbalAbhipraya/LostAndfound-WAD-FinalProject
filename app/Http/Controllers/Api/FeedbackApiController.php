<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeedbackResource;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackApiController extends Controller
{        
        public function FeedbackApi(){

                $feedback = Feedback::latest()->paginate(5);

                return new FeedbackResource(true, 'All Feedback Report', $feedback);
        }

}
