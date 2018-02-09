<?php

namespace App\Api\V1\Order\Repositories;


use App\Api\V1\Order\Contracts\OrderRepositoryInterface;
use App\Api\V1\Order\Models\OrderItemModel;
use App\Api\V1\Order\Models\OrderModel;
use App\Api\V1\Product\Models\ProductModel;
use App\Enum\HttpResponseStatusCodeEnum;
use App\Enum\ResponseEnum;
use App\Utils\HelperUtils;
use App\Utils\NumberUtils;
use DB;
use Illuminate\Database\Eloquent\Collection;

class OrderRepository implements OrderRepositoryInterface
{

    /**
     * @param array $data
     *
     * @return Collection
     */
    public function getAll(array $data): Collection
    {
        if (empty($data) || (count($data) === 1 && ! empty(HelperUtils::array_get($data, 'response_type', null)))) {
            return OrderModel::with('pessoa', 'item.produto')->get();
        }

        $orders = OrderModel::with('pessoa', 'item.produto')->where(function ($q) use ($data) {
            $q->whereHas('pessoa', function ($query) use ($data) {
                if ( ! empty(HelperUtils::array_get($data, 'pessoa', null))) {
                    $query->where('nome', 'like', "%{$data['pessoa']}%");
                }
                if ( ! empty(HelperUtils::array_get($data, 'cpf', null)) && NumberUtils::formatCpf($data['cpf'])) {
                    $query->where('cpf', '=', NumberUtils::formatCpf($data['cpf']));
                }
            });

            $q->whereHas('item.produto', function ($query) use ($data) {
                if ( ! empty(HelperUtils::array_get($data, 'produto', null))) {
                    $query->where('nome', 'like', "%{$data['produto']}%");
                }
            });

            if ( ! empty(HelperUtils::array_get($data, 'numero', null))) {
                $q->where('numero', 'like', "%{$data['numero']}%");
            }
            if ( ! empty(array_get($data, 'emissao', 0))) {
                $q->where('emissao', '=', $data['emissao']);
            }
            if ( ! empty(array_get($data, 'total', 0))) {
                $q->where('total', '=', $data['total']);
            }
        })->get();

        return $orders;

    }

    /**
     * @param string $id
     *
     * @return OrderModel|null
     */
    public function getById(string $id): ?OrderModel
    {
        $order = OrderModel::with('pessoa', 'item.produto')->find($id);

        if (empty($order)) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::NOT_FOUND);
        }

        return $order;
    }

    /**
     * @param array $data
     *
     * @return OrderModel
     */
    public function create(array $data): OrderModel
    {
        return DB::transaction(function () use ($data) {

            $order = self::saveOrder($data);

            $orderTotal = 0;
            foreach ($data['item'] as $item) {
                $orderItem = new OrderItemModel();
                $product   = ProductModel::find($item['id']);

                $price    = number_format($product->preco_unitario, 2, '.', '');
                $discount = number_format($item['desconto'], 2, '.', '');
                $total    = ($price - ($discount / 100) * $price);
                if ($product) {
                    $orderItem->pedido         = $order->id;
                    $orderItem->produto        = $product->id;
                    $orderItem->preco_unitario = $product->preco_unitario;
                    $orderItem->desconto       = $item['desconto'];
                    $orderItem->total          = $total;
                    $orderItem->save();

                    $orderTotal += $total;
                }

            }

            $order->total = $orderTotal;
            $order->save();

            return $order;

        });
    }

    /**
     * @param array  $data
     * @param string $id
     *
     * @return OrderModel
     */
    public function update(array $data, string $id): OrderModel
    {
        return DB::transaction(function () use ($data, $id) {

            $order = self::saveOrder($data, $id);

            $order->item()->delete();

            $orderTotal = 0;
            foreach ($data['item'] as $item) {
                $orderItem = new OrderItemModel();
                $product   = ProductModel::find($item['id']);

                $price    = number_format($product->preco_unitario, 2, '.', '');
                $discount = number_format($item['desconto'], 2, '.', '');
                $total    = ($price - ($discount / 100) * $price);
                if ($product) {
                    $orderItem->pedido         = $order->id;
                    $orderItem->produto        = $product->id;
                    $orderItem->preco_unitario = $product->preco_unitario;
                    $orderItem->desconto       = $item['desconto'];
                    $orderItem->total          = $total;
                    $orderItem->save();

                    $orderTotal += $total;
                }

            }

            $order->total = $orderTotal;
            $order->save();

            return $order;
        });
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function delete(string $id): bool
    {
        $order = OrderModel::destroy($id);

        if ( ! $order) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::NOT_FOUND);
        }

        return $order;
    }


    /**
     * @param array       $data
     * @param string|null $id
     *
     * @return OrderModel
     */
    private function saveOrder(array $data, ?string $id = null): OrderModel
    {
        if ( ! HelperUtils::validateFields($data, ['emissao', 'item'])
             || empty(array_get($data, 'pessoa.id', null))
             || count($data['item']) === 0
        ) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::DATA_IS_NULL);
        }

        if (is_null($id)) {
            $order = new OrderModel();
        } elseif ( ! $order = OrderModel::find($id)) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::NOT_FOUND);
        }

        $order->cliente = HelperUtils::array_get($data, 'pessoa.id', $order->cliente ?: null);
        $order->emissao = HelperUtils::array_get($data, 'emissao', $order->emissao ?: null);
        $order->total   = HelperUtils::array_get($data, 'total', $order->total ?: 1);
        $order->save();

        return $order;
    }
}