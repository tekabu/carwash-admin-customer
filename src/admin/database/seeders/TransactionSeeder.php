<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\VehicleType;
use App\Models\SoapType;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all customers, vehicle types, and soap types
        $customers = Customer::all();
        $vehicleTypes = VehicleType::all();
        $soapTypes = SoapType::all();

        // Check if we have the required data
        if ($vehicleTypes->isEmpty() || $soapTypes->isEmpty()) {
            $this->command->error('Please seed vehicle_types and soap_types first!');
            return;
        }

        // Create 100 transactions with random dates in 2025
        for ($i = 0; $i < 100; $i++) {
            $isGuest = rand(0, 1); // Randomly decide if it's a guest

            // Generate random date in 2025
            $randomDate = \Carbon\Carbon::create(2025, rand(1, 12), rand(1, 28))
                ->setTime(rand(8, 18), rand(0, 59), rand(0, 59));

            Transaction::create([
                'is_guest' => $isGuest,
                'customer_id' => $isGuest ? null : ($customers->isNotEmpty() ? $customers->random()->id : null),
                'vehicle_type_id' => $vehicleTypes->random()->id,
                'soap_type_id' => $soapTypes->random()->id,
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);
        }

        $this->command->info('Created 100 transaction records successfully!');
    }
}
