<?php

namespace Database\Seeders;

use App\Models\CylinderType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CylinderTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'id' => 1,
                'name' => 'Commercial (45.4kg)',
                'description' => '',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'name' => 'Domestic (11.8kg)',
                'description' => '',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'name' => 'Domestic (6kg)',
                'description' => '',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'name' => 'Domestic (10kg)',
                'description' => '',
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
            ],
        ];
    
        CylinderType::insert($types);
    }
}
