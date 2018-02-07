<?php

namespace App\Utils;


class NumberUtils
{

    /**
     * @param $string
     * @return mixed
     */
    public static function numbersOnly($string)
    {
        return preg_replace('/[^0-9]/', '', $string);
    }

}