<?php

namespace App\Enum;


abstract class HttpResponseStatusCodeEnum
{
    //Successful responses
    const OK = 200;
    const CREATE = 201;
    const NO_CONTENT = 204;

    //Client error responses
    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const NOT_FOUND = 404;

    //Server error responses
    const INTERNAL_SERVER_ERROR = 503;
}