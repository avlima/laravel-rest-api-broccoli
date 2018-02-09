<?php

namespace App\Api\V1\Person\Models;


use App\Models\BaseModel;
use App\Api\V1\Person\Models\PersonModel as Person;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Person\PersonModel
 *
 * @property string $id
 * @property string $nome
 * @property string $cpf
 * @property \Carbon\Carbon $data_nascimento
 * @method static Builder|Person whereId($value)
 * @method static Builder|Person whereNome($value)
 * @method static Builder|Person whereCpf($value)
 * @method static Builder|Person whereDataNascimento($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
class PersonModel extends BaseModel
{
    protected $table = 'pessoa';
}