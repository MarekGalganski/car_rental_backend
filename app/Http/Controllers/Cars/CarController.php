<?php

namespace App\Http\Controllers\cars;

use App\Models\Car;
use App\Http\Resources\CarResource;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    public function index()
    {
        // return CarResource::collection(
        //     Car::all()
        // );
        return Car::paginate(5);
    }

    public function show($id)
    {
        return new CarResource(Car::findOrFail($id));
    }
}
