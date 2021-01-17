<?php

namespace App\Http\Controllers\Cars;

use App\Models\User;
use App\Models\CarBooking;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserBookingsResource;

class CarBookingController extends Controller
{
    public function getUserBookings($id)
    {
        User::findOrFail($id);
        $bookings = CarBooking::with('car')
            ->where('user_id', $id)->orderBy('created_at', 'desc')
            ->get();

        return UserBookingsResource::collection($bookings);
    }
}
