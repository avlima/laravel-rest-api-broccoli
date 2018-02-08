<?php

namespace App\Enum;


abstract class ResponseEnum
{
    //Successful responses
    const OBJECT_CREATED = 'Object successfully created';
    const OBJECT_UPDATED = 'Object successfully updated';

    //Client error responses
    const BAD_REQUEST = 'Bad request';
    const NOT_FOUND = 'Does not exist';

    //Sever error responses
    const INTERNAL_SERVER_ERROR = 'Internal Server error';

    const ALREADY_EXISTS = 'Already exists';
    const HAS_RELATION = 'Has relation';
    const DATA_IS_NULL = 'Data is null';
}