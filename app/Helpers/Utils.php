<?php
namespace App\Helpers;

use App\Inscripcion;
use App\User;
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
    
    public static function saveSetting($key, $value)
    {
        Setting::where('key', '=', $key)->update(['value' => $value]);

        return;
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

    public static function verifiedUsersData()
    {
        $data = [];

            $verified = User::where('confirmed', '=', '1')->count();
            $notVerified = User::where('confirmed', '=', '0')->count();
            $data[] = ['label' => 'Verificados', 'value' => $verified];
            $data[] = ['label' => 'No verificados', 'value' => $notVerified];


        return json_encode($data);
    }

    public static function inscriptionChannels($cursoId = null, $fromDate = null, $endDate = null)
    {
        $channels = config('custom.commons.inscription_channels');
        $data = [];

        foreach($channels as $channel){
            $inscriptions = Inscripcion::where('canal', $channel)->count();
            $data[] = ['label' => $channel, 'value' => $inscriptions];
        }
        //dd($data);
        return json_encode($data);
    }


    public static function generarCodigo() {
        $letras = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 4);
        $numeros = substr(str_shuffle('0123456789'), 0, 2);
        return $letras . $numeros;
    }


    /**
     * Extrae únicamente las propiedades especificadas de un objeto stdClass.
     *
     * Esta función imita el comportamiento del método `only()` usado en Eloquent y colecciones de Laravel
     *
     * @param stdClass $object El objeto original desde el cual se desean extraer propiedades.
     * @param array $keys Un arreglo de nombres de propiedades que se quieren conservar.
     *
     * @return stdClass Un nuevo objeto stdClass que contiene solo las propiedades especificadas.
     *
     * @example
     * $usuario = (object) [
     *     'id' => 1,
     *     'nombre' => 'Lucía',
     *     'email' => 'lucia@example.com',
     *     'edad' => 29
     * ];
     *
     * $filtrado = onlyFromStdClass($usuario, ['nombre', 'email']);
     * // Resultado:
     * // stdClass Object
     * // (
     * //     [nombre] => Lucía
     * //     [email] => lucia@example.com
     * // )
     */
    public static function onlyFromStdClass($object, array $keys)
    {
        $original = (array) $object;
        $result = [];

        foreach ($keys as $key) {
            if (array_key_exists($key, $original)) {
                $result[$key] = $original[$key];
            }
        }

        return (object) $result;
    }
}