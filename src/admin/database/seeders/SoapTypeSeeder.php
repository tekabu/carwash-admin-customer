<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SoapType;

class SoapTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $soapTypes = [
            [
                'soap_type' => 'Basic',
                'sub_title' => 'Standard wash soap',
                'image_url' => null,
                'amount' => 50.00,
            ],
            [
                'soap_type' => 'Premium',
                'sub_title' => 'Premium quality soap with wax',
                'image_url' => null,
                'amount' => 100.00,
            ],
        ];

        foreach ($soapTypes as $type) {
            SoapType::create($type);
        }

        $this->command->info('Created ' . count($soapTypes) . ' soap type records successfully!');
    }
}
