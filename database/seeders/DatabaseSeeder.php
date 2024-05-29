<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\Api\Company\BranchSeeder;
use Database\Seeders\Api\Company\CompanySeeder;
use Database\Seeders\Api\Company\DepartmentSeeder;
use Database\Seeders\Api\Company\EmployeeSeeder;
use Database\Seeders\Api\Company\PositionSeeder;
use Database\Seeders\Api\UserSeeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            CompanySeeder::class,
            BranchSeeder::class,
            DepartmentSeeder::class,
            PositionSeeder::class,
            EmployeeSeeder::class,
            UserSeeder::class
        ]);
    }
}
