<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentModels;

class PaymentModelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $paymentModels = [
            [
                'name' => 'IBAN',
                'status' => 1,
                'key' => 'iban',
                'value' => 'TR050020500009671719700002',
            ],
            [
                'name' => 'Iyzico',
                'status' => 1,
                'key' => 'iyzico',
            ],
        ];

        foreach ($paymentModels as $paymentModel) {
            \App\Models\PaymentModels::create($paymentModel);
        }
    }
}
