<?php

namespace Database\Factories\Api\Company;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Api\Company\Company>
 */
class CompanyFactory extends Factory
{

    public function definition(): array
    {
        $company = fake()->unique()->company();
        return [
            'name' => $company,
            'business_name' => $company .' '. fake()->companySuffix(),
            'address' => fake()->address(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'postal_code' => fake()->postcode(),
            'created_by' => fake()->name(),
            'updated_by' => fake()->name()
        ];
    }
}
