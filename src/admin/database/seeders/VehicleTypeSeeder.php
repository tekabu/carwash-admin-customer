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
                'vehicle_type' => 'Small Motorcycle',
                'sub_title' => 'Compact bikes and scooters',
                'image_url' => null,
                'amount' => 50.00,
            ],
            [
                'vehicle_type' => 'Small Sedan',
                'sub_title' => 'Compact and mid-size cars',
                'image_url' => null,
                'amount' => 75.00,
            ],
            [
                'vehicle_type' => 'Medium Suv',
                'sub_title' => 'SUVs and crossovers',
                'image_url' => null,
                'amount' => 100.00,
            ],
            [
                'vehicle_type' => 'Medium Pickup',
                'sub_title' => 'Standard pickup trucks',
                'image_url' => null,
                'amount' => 100.00,
            ],
            [
                'vehicle_type' => 'Large Van',
                'sub_title' => 'Vans and large vehicles',
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
