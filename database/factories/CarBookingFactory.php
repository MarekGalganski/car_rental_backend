<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\CarBooking;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarBookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CarBooking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $from = Carbon::instance($this->faker->dateTimeBetween('-1 months', '+1 months'));
        $to = (clone $from)->addDays(random_int(0, 14));

        return [
            'from' => $from,
            'to' => $to,
            'price' => random_int(222, 2000)
        ];
    }
}
