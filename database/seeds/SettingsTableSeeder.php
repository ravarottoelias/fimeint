<?php

use App\Setting;
use App\InscriptionPayment;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create settings
        $settings = [
            [
                'key' => 'paypal_integration_enabled',
                'value' => '1',
            ],
            [
                'key' => 'mercadopago_integration_enabled',
                'value' => '1',
            ],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }

    }
}