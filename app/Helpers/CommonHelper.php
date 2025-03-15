<?php

namespace App\Helpers;

class CommonHelper
{
    /**
     * Include all .php file under the folder path provided.
     */
    public static function thousandFormat($value)
    {
        return number_format($value, 0, ',', '.');
    }
}
