<?php

namespace App\Http\Controllers\Cars;

use App\Models\Car;
use App\Http\Resources\CarResource;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    public function index()
    {
        return Car::paginate(6);
    }

    public function show($id)
    {
        return new CarResource(Car::findOrFail($id));
    }
}
