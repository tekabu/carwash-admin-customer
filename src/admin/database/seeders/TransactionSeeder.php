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

            $vehicleType = $vehicleTypes->random();
            $soapType = $soapTypes->random();
            $vehicleAmount = round((float) $vehicleType->amount, 2);
            $soapAmount = round((float) $soapType->amount, 2);
            $totalAmount = round($vehicleAmount + $soapAmount, 2);

            $customer = null;
            if (!$isGuest && $customers->isNotEmpty()) {
                $customer = $customers->random();
            }

            $customerName = $customer?->name ?? '';
            $currentBalance = $customer ? round($totalAmount + rand(0, 10000) / 100, 2) : null;
            $newBalance = $customer ? round($currentBalance - $totalAmount, 2) : null;

            $ratio = (int) env('POINTS_TO_BALANCE_RATIO', 1);
            $currentPoints = $customer ? round(rand(0, 5000) / 100, 4) : null;
            $newPoints = $customer ? round($currentPoints + ($totalAmount / max($ratio, 1)), 4) : null;

            // Generate random date in 2025
            $randomDate = \Carbon\Carbon::create(2025, rand(1, 12), rand(1, 28))
                ->setTime(rand(8, 18), rand(0, 59), rand(0, 59));

            Transaction::create([
                'is_guest' => $isGuest,
                'customer_id' => $customer?->id,
                'customer_name' => $customerName,
                'vehicle_type_id' => $vehicleType->id,
                'vehicle_type' => $vehicleType->vehicle_type,
                'vehicle_type_amount' => $vehicleAmount,
                'soap_type_id' => $soapType->id,
                'soap_type' => $soapType->soap_type,
                'soap_type_amount' => $soapAmount,
                'total_amount' => $totalAmount,
                'current_balance' => $currentBalance,
                'new_balance' => $newBalance,
                'current_points' => $currentPoints,
                'new_points' => $newPoints,
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);
        }

        $this->command->info('Created 100 transaction records successfully!');
    }
}
