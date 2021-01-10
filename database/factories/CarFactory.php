<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Car::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'brand' => $this->faker->randomElement([
                'Audi',
                'Mercedes',
                'Suzuki',
                'Mazda',
                'Kia',
                'Nissan',
                'Opel'
            ]),
            'model' => $this->faker->randomElement([
                'Sedan',
                'Coupe',
                'Hatchback',
                'Minivan',
                'Suv',
                'PickupTruck'
            ]),
            'description' => $this->faker->text(),
            'price' => random_int(100, 2000),
        ];
    }
}
