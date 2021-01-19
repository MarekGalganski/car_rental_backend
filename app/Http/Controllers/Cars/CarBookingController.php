<?php

namespace App\Http\Controllers\Cars;

use App\Models\User;
use App\Models\CarBooking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarBookingRequest;
use App\Http\Resources\UserBookingsResource;

class CarBookingController extends Controller
{
    public function getUserBookings($id, CarBookingRequest $request)
    {
        User::findOrFail($id);
        $bookings = CarBooking::with('car')
            ->where('user_id', $id)
            ->orderBy('created_at', 'desc')
            ->paginate($request->perPage);

        return UserBookingsResource::collection($bookings);
    }
}
