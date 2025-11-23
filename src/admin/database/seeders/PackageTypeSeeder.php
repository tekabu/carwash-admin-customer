<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PackageType;

class PackageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packageTypes = [
            'Basic',
            'Premium',
        ];

        foreach ($packageTypes as $type) {
            PackageType::create([
                'package_type' => $type,
            ]);
        }
    }
}
