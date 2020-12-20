<?php

namespace App\Http\Controllers\Review;

use App\Models\Review;
use App\Models\CarBooking;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewStoreRequest;
use App\Http\Resources\Review\CarReviewIndexResource;

class ReviewController extends Controller
{
    public function show($id)
    {
        if (Review::findOrFail($id))
        {
            return response()->json(['alreadyExists' => true]);
        }
    }

    public function store(ReviewStoreRequest $request)
    {
        $carBooking = CarBooking::findByReviewKey($request->id);

        if (!$carBooking) {
            abort(404);
        }

        $carBooking->review_key = '';
        $carBooking->save();

        $review = Review::make($request->validated());
        $review->car_booking_id = $carBooking->id;
        $review->car_id = $carBooking->car_id;
        $review->save();

        return new CarReviewIndexResource($review);
    }
}
