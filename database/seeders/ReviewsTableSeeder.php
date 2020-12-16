<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Review;
use Illuminate\Database\Seeder;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Car::all()->each(function (Car $car) {
            $reviews = Review::factory()->times(random_int(5, 30))->make();
            $car->reviews()->saveMany($reviews);
        });
    }
}
