<?php

namespace App\Http\Controllers\Basket;

use App\Models\CarBooking;
use App\Models\UserAddress;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckoutRequest;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CheckoutRequest $request)
    {
        $bookingsData = $request->bookings;
        $addressData = $request->address;

        $carBookings = collect($bookingsData)->map(function($bookingData) use ($addressData) {

            $carBooking = new CarBooking();
            $carBooking->from = $bookingData['from'];
            $carBooking->to = $bookingData['to'];
            $carBooking->car_id = $bookingData['car_id'];
            $carBooking->price = 500;

            $carBooking->address()->associate(UserAddress::create($addressData));

            $carBooking->save();
            return $carBooking;
        });

        return $carBookings;
    }
}
