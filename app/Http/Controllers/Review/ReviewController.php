<?php

namespace App\Http\Controllers\Review;

use App\Models\Review;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function show($id)
    {
        if (Review::findOrFail($id))
        {
            return response()->json(['alreadyExists' => true]);
        }
    }
}
