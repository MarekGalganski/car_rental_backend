<?php

namespace App\Http\Controllers\Review;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Review\CarReviewIndexResource;

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

        return $car->reviews()->latest()->paginate(2);
    }
}
