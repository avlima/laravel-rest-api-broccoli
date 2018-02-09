<?php

namespace App\Api\V1\Order\Models;


use App\Api\V1\Product\Models\ProductModel;
use App\Models\BaseModel;
use App\Api\V1\Order\Models\OrderItemModel as OrderItem;
use Illuminate\Database\Query\Builder;

/**
 * App\Models\Order\OrderModel
 *
 * @property string $id
 * @property string $produto
 * @property string $pedido
 * @property float  $preco_unitario
 * @property float  $desconto
 * @property float  $total
 * @method static Builder|OrderItem whereId($value)
 * @method static Builder|OrderItem whereProduto($value)
 * @method static Builder|OrderItem wherePedido($value)
 * @method static Builder|OrderItem wherePrecoUnitario($value)
 * @method static Builder|OrderItem whereDesconto($value)
 * @method static Builder|OrderItem whereTotal($value)
 * @mixin \Illuminate\Database\Eloquent\Model
 */
class OrderItemModel extends BaseModel
{
    protected $table = 'item_pedido';

    protected $hidden = ['pedido'];

    /**
     * Get the Product.
     */
    public function produto()
    {
        return $this->hasOne(ProductModel::class, 'id', 'produto');
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = parent::toArray();

        unset($data['id']);

        $data['id'] = $data['produto']['id'];
        $data['codigo'] = $data['produto']['codigo'];
        $data['nome'] = $data['produto']['nome'];

        unset($data['produto']);

        return $data;
    }
}