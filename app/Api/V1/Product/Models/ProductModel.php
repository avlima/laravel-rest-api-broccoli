<?php

namespace App\Api\V1\Product\Models;


use App\Models\BaseModel;
use App\Api\V1\Product\Models\ProductModel as Product;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Person\PersonModel
 *
 * @property string $id
 * @property string $codigo
 * @property string $nome
 * @property float $preco_unitario
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereCodigo($value)
 * @method static Builder|Product whereNome($value)
 * @method static Builder|Product wherePrecoUnitario($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
class ProductModel extends BaseModel
{
    protected $table = 'produto';
}