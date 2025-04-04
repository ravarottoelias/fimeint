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
            // [
            //     'key' => 'paypal_integration_enabled',
            //     'value' => '1',
            // ],
            // [
            //     'key' => 'mercadopago_integration_enabled',
            //     'value' => '1',
            // ],
            // [
            //     'key' => 'last_certificate_number',
            //     'value' => '1',
            // ],
            // [
            //     'key' => 'last_certificate_tomo',
            //     'value' => '1',
            // ],
            // [
            //     'key' => 'last_certificate_folio',
            //     'value' => '1',
            // ],
            [
                'key' => 'quantity_folio_por_tomo',
                'value' => '99',
            ]
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }

    }
}