<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;
use App\Models\Customer;
use App\Models\User;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'password' => Hash::make('12345'),
                'type' => 'customer',
                'email_verified_at' => now()
            ]);

            Customer::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
                'rfid' => 'RFID' . str_pad($i + 1, 8, '0', STR_PAD_LEFT),
                'balance' => rand(0, 5000),
                'points' => fake()->randomFloat(4, 0, 1000),
            ]);
        }

        $this->command->info('Created 10 customer records successfully!');
    }
}
