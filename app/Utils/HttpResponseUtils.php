<?php

namespace App\Utils;

use SoapBox\Formatter\Formatter;

trait HttpResponseUtils
{
    /**
     * @param array $data
     * @param string $type
     * @return mixed
     */
    static function httpResponse(array $data, string $type = 'json')
    {
        $formatter = Formatter::make($data, Formatter::ARR);

        switch ($type) {
            case 'array':
                $result = $formatter->toArray();
                break;
            case 'yaml':
                $result = $formatter->toYaml();
                break;
            case 'xml':
                $result = $formatter->toXml();
                break;
            case 'csv':
                $result = $formatter->toCsv();
                break;
            case 'json':
                $result = $formatter->toJson();
                break;
            default:
                $result = false;
        }

        if(!$result){
            abort(400, "The reported return type '{$type}' is invalid");
        }
        return $result;
    }

    /**
     * Return Bad Request.
     * @param int $code
     * @param string $message
     * @return array
     */
    static function httpClientError(int $code, string $message = ''): array
    {
        return [
            'status' => 'error',
            'code' => $code,
            'message' => $message,
            'data' => ''
        ];
    }

    /**
     * Return Http Success.
     * @param int $code
     * @param $data
     * @param string $message
     * @return array
     */
    static function httpSuccess(int $code, $data, string $message = ''): array
    {
        return [
            'status' => 'success',
            'code' => $code,
            'message' => $message,
            'data' => $data
        ];
    }
}