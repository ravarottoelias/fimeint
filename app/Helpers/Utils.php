<?php
namespace App\Helpers;

use App\Setting;

class Utils
{
    public static function formatPrice($float)
    {
        $english_format_number = number_format($float, 2, '.', '');

        return $english_format_number;
    }

    // Get Setting
    public static function getSetting($key)
    {
        $settingValue = Setting::where('key', '=', $key)->pluck('value');

        return $settingValue[0];
    }

    //get Settings
    public static function getSettings()
    {
        $settings = Setting::all();
        $settings_array = [];

        foreach ($settings as $setting) {
            $settings_array[$setting->key] = $setting->value;
        }

        return $settings_array;
    }
}