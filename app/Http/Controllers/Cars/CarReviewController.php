<?php

namespace App\Http\Controllers\Cars;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarReviewIndexResource;

class CarReviewController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, Request $request)
    {
        $car = Car::findOrFail($id);

        return CarReviewIndexResource::collection(
            $car->reviews()->latest()->get()
        );
    }
}
