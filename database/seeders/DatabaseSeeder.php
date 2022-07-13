<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create();
        $this->call(CylinderTypesSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(BranchSeeder::class);
    }
}
