<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings;
use App\Models\PaymentModels;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Settings::create([
            'site_title' => 'Site Name',
            'site_description' => 'Site Description',
            'site_keywords' => 'Site Keywords',
        ]);

        PaymentModels::create(
            [
                'name' => 'IBAN',
                'key' => 'iban',
                'value' => '-',
                'status' => 1,
            ],
            [
                'name' => 'Iyzico',
                'key' => 'iyzico',
                'value' => '-',
                'status' => 1,
            ]
        );
    }
}
