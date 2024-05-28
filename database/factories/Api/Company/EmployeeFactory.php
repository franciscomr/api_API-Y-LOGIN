<?php

namespace Database\Factories\Api\Company;

use App\Models\Api\Company\Branch;
use App\Models\Api\Company\Job;
use App\Models\Api\Company\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\Company\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $branches = Branch::max('id');
        $positions = Position::max('id');

        return [
            'branch_id' => fake()->numberBetween(1, $branches - 1),
            'position_id' => fake()->numberBetween(1, $positions - 1),
            'name' => fake()->unique()->firstName(),
            'first_surname' => fake()->unique()->lastName(),
            'second_surname' => fake()->unique()->lastName(),
            'identifier' => fake()->numberBetween(3500, 9999),
            'hire_date' => fake()->date(),
            'created_by' => fake()->name(),
            'updated_by' => fake()->name()
        ];
    }
}
