<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VehicleType;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vehicleTypes = [
            [
                'vehicle_type' => 'SMALL 1',
                'sub_title' => 'Motorcycle',
                'image_url' => null,
                'amount' => 50.00,
            ],
            [
                'vehicle_type' => 'SMALL 2',
                'sub_title' => 'Sedan',
                'image_url' => null,
                'amount' => 75.00,
            ],
            [
                'vehicle_type' => 'MEDIUM 1',
                'sub_title' => 'SUV',
                'image_url' => null,
                'amount' => 100.00,
            ],
            [
                'vehicle_type' => 'MEDIUM 2',
                'sub_title' => 'Pickup',
                'image_url' => null,
                'amount' => 100.00,
            ],
            [
                'vehicle_type' => 'LARGE',
                'sub_title' => 'Van',
                'image_url' => null,
                'amount' => 150.00,
            ],
        ];

        foreach ($vehicleTypes as $type) {
            VehicleType::create($type);
        }

        $this->command->info('Created ' . count($vehicleTypes) . ' vehicle type records successfully!');
    }
}
