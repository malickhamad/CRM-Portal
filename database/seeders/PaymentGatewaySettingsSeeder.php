<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class PaymentGatewaySettingsSeeder extends Seeder
{
    public function run()
    {
        $paymentSettings = [
            'stripe_secret_key' => 'your_stripe_secret_key',
            'stripe_api_key' => 'your_stripe_api_key',
            'stripe_active' => 'true',
        ];

        foreach ($paymentSettings as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key, 'group' => 'payment'],
                ['value' => $value]
            );
        }
    }
}
