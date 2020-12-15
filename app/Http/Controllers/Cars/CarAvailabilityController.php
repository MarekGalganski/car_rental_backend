<?php

namespace App\Http\Controllers\Cars;

use App\Models\Car;
use App\Http\Controllers\Controller;
use App\Http\Requests\CarAvailabilityRequest;

class CarAvailabilityController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, CarAvailabilityRequest $request)
    {
        $car = Car::findOrFail($id);

        return $car->availableFor($request->from, $request->to)
            ? response()->json([])
            : response()->json([], 404);
    }
}
