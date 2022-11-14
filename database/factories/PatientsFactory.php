<?php

namespace Database\Factories;

use App\Models\Patients;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Patients::class;

    public function definition()
    {
        $this->faker->randomElement(['active', 'completed', 'on hold']);
        return [
            'choices' => $this->faker->randomElement(['X', 'Y']),
            'name' => $this->faker->name(),
            'age' => $this->faker->numberBetween(18,65),
            'type' => $this->faker->name(),
           
            'num' => $this->faker->phoneNumber(),
            'serie' => $this->faker->unique()->name(),
            'paye' => $this->faker->numberBetween(1000,3000),
            'reste' => $this->faker->numberBetween(1000,3000),

            'description' => $this->faker->paragraph(),
            

            
        ];
    }
}
