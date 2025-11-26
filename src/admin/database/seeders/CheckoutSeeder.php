<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Checkout;
use App\Models\Customer;
use App\Models\VehicleType;
use App\Models\SoapType;

class CheckoutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param int $count Number of checkout records to create (default: 1)
     */
    public function run(int $count = 1): void
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

        if ($customers->isEmpty()) {
            $this->command->warn('No customers found. Creating checkouts without customer association.');
        }

        // Get ratio from .env
        $ratio = (int) env('POINTS_TO_BALANCE_RATIO', 1);

        // Payment types
        $paymentTypes = ['balance deduction', 'cash'];
        $paymentStatuses = ['pending', 'done'];

        // Create checkout records with random dates in 2025
        for ($i = 0; $i < $count; $i++) {
            // Randomly decide if it's a guest checkout
            $isGuest = rand(0, 1);

            // Select random vehicle type and soap type
            $vehicleType = $vehicleTypes->random();
            $soapType = $soapTypes->random();

            // Calculate total amount (vehicle type amount + soap type amount)
            $totalAmount = ($vehicleType->amount ?? 0) + ($soapType->amount ?? 0);

            // Calculate points
            $points = round($totalAmount * $ratio, 4);

            // Randomly select payment type
            $paymentType = $paymentTypes[array_rand($paymentTypes)];

            // 80% chance of being done, 20% pending
            $paymentStatus = rand(1, 100) <= 80 ? 'done' : 'pending';

            // Generate random date in 2025
            $randomDate = \Carbon\Carbon::create(2025, rand(1, 12), rand(1, 28))
                ->setTime(rand(8, 18), rand(0, 59), rand(0, 59));

            Checkout::create([
                'customer_id' => $isGuest ? null : ($customers->isNotEmpty() ? $customers->random()->id : null),
                'reference' => Str::uuid(),
                'vehicle_type_id' => $vehicleType->id,
                'soap_type_id' => $soapType->id,
                'total_amount' => $totalAmount,
                'payment_type' => $paymentType,
                'payment_status' => $paymentStatus,
                'points' => $points,
                'ratio' => $ratio,
                'created_at' => $randomDate,
                'updated_at' => $randomDate,
            ]);
        }

        $this->command->info("Created {$count} checkout record(s) successfully!");
    }
}
