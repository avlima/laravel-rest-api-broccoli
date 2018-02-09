<?php

namespace App\Utils;


class NumberUtils
{

    /**
     * @param $string
     *
     * @return mixed
     */
    public static function numbersOnly(string $string)
    {
        return preg_replace('/[^0-9]/is', '', $string);
    }

    /**
     * @param $cpf
     *
     * @return mixed
     */
    public static function formatCpf(string $cpf)
    {
        $cpf = self::numbersOnly($cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})$/', '${1}.${2}.${3}-${4}', $cpf);
    }

    /**
     * @param string $cpf
     *
     * @return mixed
     */
    public static function validateCpf(string $cpf)
    {
        $cpf = self::numbersOnly($cpf);


        if (strlen($cpf) != 11) {
            return false;
        }
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }

        return true;
    }

}