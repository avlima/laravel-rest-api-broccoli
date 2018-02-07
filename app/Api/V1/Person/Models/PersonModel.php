<?php

namespace App\Api\V1\Person\Models;


use App\Api\V1\Address\Models\AddressModel;
use App\Api\V1\Email\Models\EmailModel;
use App\Api\V1\Phone\Models\PhoneModel;
use App\Models\BaseModel;

class PersonModel extends BaseModel
{
    protected $table = 'pessoa';
}