<?php

namespace App\Helper;

class TanslationHelper
{
    public static function translate($key)
    {
        $local = app()->getLocale();
        app()->setLocale($local);

        $lang_array = include(base_path('resources/lang/en/api.php'));
        $processed_key = ucfirst(str_replace('_', ' ', TanslationHelper::remove_invalid_charcaters($key)));

        if (!array_key_exists($key, $lang_array)) {
            $lang_array[$key] = $processed_key;
            $str = "<?php return " . var_export($lang_array, true) . ";";
            file_put_contents(base_path('resources/lang/en/api.php'), $str);
            $result = $processed_key;
        } else {
            $result = __('api.' . $key);
        }

        $lang_array = include(base_path('resources/lang/ar/api.php'));
        $processed_key = ucfirst(str_replace('_', ' ', TanslationHelper::remove_invalid_charcaters($key)));

        if (!array_key_exists($key, $lang_array)) {
            $lang_array[$key] = $processed_key;
            $str = "<?php return " . var_export($lang_array, true) . ";";
            file_put_contents(base_path('resources/lang/ar/api.php'), $str);
            $result = $processed_key;
        } else {
            $result = __('api.' . $key);
        }

        $result = __('api.' . $key);
        return $result;
    }

    public static function remove_invalid_charcaters($str)
    {
        return str_ireplace(['\'', '"', ',', ';', '<', '>', '?'], ' ', $str);
    }


}
