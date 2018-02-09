<?php

namespace App\Api\V1\Order\Models;


use App\Api\V1\Person\Models\PersonModel;
use App\Models\BaseModel;
use App\Api\V1\Order\Models\OrderModel as Order;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Order\OrderModel
 *
 * @property string $id
 * @property string $cliente
 * @property int $numero
 * @property \Carbon\Carbon $emissao
 * @property float $total
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereCliente($value)
 * @method static Builder|Order whereNumero($value)
 * @method static Builder|Order whereEmissao($value)
 * @method static Builder|Order whereTotal($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
class OrderModel extends BaseModel
{
    protected $table = 'pedido';

    /**
     * Get the Person.
     */
    public function pessoa()
    {
        return $this->hasOne(PersonModel::class, 'id', 'cliente');
    }

    /**
     * Get the Product.
     */
    public function item()
    {
        return $this->hasMany(OrderItemModel::class, 'pedido', 'id');
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();

        unset($data['cliente']);

        return $data;
    }
}