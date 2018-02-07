<?php

namespace App\Utils;


class HelperUtils
{
    /**
     * @param array $array
     * @param int $key
     * @param null $default
     * @return mixed|null
     */
    public static function array_get(array $array, $key, $default = null)
    {
        $data = array_get($array, $key, $default);

        if (empty($data) && $data != 0) {
            $data = null;
        }

        return $data;
    }

    /**
     * @param array|null $array
     * @param array $fields
     * @return bool
     */
    public static function validateFields(array $array = null, array $fields)
    {
        if (is_null($array)) {
            foreach ($fields as $field) {
                if (empty($field) && $field != 0) {
                    return false;
                }
            }
        } else {
            foreach ($fields as $field) {
                if (self::array_get($array, $field) === null) {
                    return false;
                }
            }
        }

        return true;
    }

}