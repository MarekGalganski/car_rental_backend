<?php

namespace App\Http\Controllers\Cars;

use Carbon\Carbon;
use App\Models\Car;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarPriceRequest;

class CarPriceController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, CarPriceRequest $request)
    {
        $car = Car::findOrFail($id);

        $days = (new Carbon($request->from))->diffInDays(new Carbon($request->to)) + 1;
        $totalPrice = $days * $car->price;

        return response()->json([
            'data' => [
                'totalPrice' => $totalPrice,
                'breakdown' => [
                    $car->price => $days
                ]
            ]
        ]);
    }
}
