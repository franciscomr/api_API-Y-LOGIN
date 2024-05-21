<?php

namespace Database\Factories\Api\Company;

use App\Models\Api\Company\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\Company\Branch>
 */
class BranchFactory extends Factory
{

    public function definition(): array
    {
        $count = Company::max('id');
        return [
            'company_id' => fake()->numberBetween(1, $count-1),
            'name' => fake()->unique()->state(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'postal_code' => fake()->postcode(),
            'created_by' => fake()->name(),
            'updated_by' => fake()->name()
        ];
    }
}
