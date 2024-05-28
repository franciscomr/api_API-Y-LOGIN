<?php

namespace Database\Factories\Api\Company;

use App\Models\Api\Company\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\Company\Position>
 */
class PositionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $count = Department::max('id');
        return [
            'department_id' => fake()->numberBetween(1, $count - 1),
            'name' => fake()->unique()->jobTitle(),
            'created_by' => fake()->name(),
            'updated_by' => fake()->name()
        ];
    }
}
