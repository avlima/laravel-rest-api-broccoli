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

    //Authentication error responses
    const ACCESS_DENIED = 'The resource owner or authorization server denied the request.';
    const USER_CREDENTIALS_INCORRECT = 'The user credentials were incorrect.';
    const CLIENT_AUTHENTICATION_FAILED = 'Client authentication failed.';
    const UNSUPPORTED_GRANT_TYPE = 'The authorization grant_type is not supported by the authorization server.';

    const ALREADY_EXISTS = 'Already exists';
    const HAS_RELATION = 'Has relation';
    const DATA_IS_NULL = 'Data is null';
}