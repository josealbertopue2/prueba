<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TaskFactory extends Factory
{
    // El modelo asociado (puede omitirse si está inferido)
    protected $model = \App\Models\Task::class;

    /**
     * @return array
     */
    public function definition(): array
    {
        return [
            'titulo'       => $this->faker->sentence(3),
            'descripcion'  => $this->faker->optional()->paragraph(),
            'completada'   => $this->faker->boolean(20), // 20% true
            'fecha_limite' => $this->faker->optional()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
        ];
    }
}
