<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Especialidad;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Especialidad>
 */
class EspecialidadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Especialidad::class;

    public function definition()
    {
        
        return [
            'nombreEspecialidad' => $this->faker->word,
            'clinica' => $this->faker->company,
            'estadoEspecialidad' => $this->faker->boolean,
        ];
    }
}
