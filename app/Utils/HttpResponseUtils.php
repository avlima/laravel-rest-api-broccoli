<?php

namespace App\Utils;

use App\Enum\HttpResponseStatusCodeEnum;
use SoapBox\Formatter\Formatter;

trait HttpResponseUtils
{
    public $response_type = 'json';

    /**
     * @param array  $data
     * @param string $type
     *
     * @return mixed
     */
    static function httpResponse(array $data, string $type = 'json')
    {
        if (count($data) === 0) {
            return $data;
        }

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

        if (!$result) {
            return response(
                self::httpClientError("The reported return type '{$type}' is invalid"),
                HttpResponseStatusCodeEnum::BAD_REQUEST)
                ->header("Content-Type", "text/json");
        }

        return $result;
    }

    /**
     * Return Bad Request.
     *
     * @param string $message
     *
     * @return array
     */
    static function httpClientError(string $message = ''): array
    {
        return [
            'status' => 'error',
            'message' => $message,
        ];
    }
}