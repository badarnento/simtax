<?php

namespace App\Helpers;

class CommonHelper
{
    
    public static function thousandFormat($value, $decimal=0)
    {
        return number_format($value, $decimal, ',', '.');
    }

    public static function thousandFormatWithComma($value, $decimal=0)
    {
        return number_format($value, $decimal, '.', ',');
    }
}
