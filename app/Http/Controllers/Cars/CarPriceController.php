<?php

namespace App\Http\Controllers\Cars;

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

        return response()->json([
            'data' => $car->priceFor($request->from, $request->to)
        ]);
    }
}
