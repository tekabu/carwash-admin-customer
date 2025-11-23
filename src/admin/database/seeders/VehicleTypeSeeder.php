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
            'Small Motorcycle',
            'Small Sedan',
            'Medium Suv',
            'Medium Pickup',
            'Large Van',
        ];

        foreach ($vehicleTypes as $type) {
            VehicleType::create([
                'vehicle_type' => $type,
            ]);
        }
    }
}
