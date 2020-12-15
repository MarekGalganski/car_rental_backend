<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\CarBooking;
use Illuminate\Database\Seeder;

class CarBookinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Car::all()->each(function (Car $car) {
            $carBooking = CarBooking::factory()->make();
            $carBookings = collect([$carBooking]);

            for ($i = 0; $i < random_int(1, 20); $i++) {
                $from = (clone $carBooking->to)->addDays(random_int(1, 14));
                $to = (clone $from)->addDays(random_int(0, 14));

                $carBooking = CarBooking::make([
                    'from' => $from,
                    'to' => $to
                ]);
                $carBookings->push($carBooking);
            }

            $car->carBookings()->saveMany($carBookings);
        });
    }
}
