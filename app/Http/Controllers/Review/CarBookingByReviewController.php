<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Http\Resources\Review\CarBookingByReviewShowResource;
use App\Models\CarBooking;

class CarBookingByReviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($reviewKey)
    {
        $carBooking = CarBooking::findByReviewKey($reviewKey);

        if (!$carBooking) {
            abort(404);
        }

        return new CarBookingByReviewShowResource(CarBooking::findByReviewKey($reviewKey));
    }
}
