<?php

namespace App\Api\V1\Product\Repositories;


use App\Api\V1\Product\Contracts\ProductRepositoryInterface;
use App\Api\V1\Product\Models\ProductModel;
use App\Enum\HttpResponseStatusCodeEnum;
use App\Enum\ResponseEnum;
use App\Utils\HelperUtils;
use DB;
use Illuminate\Database\Eloquent\Collection;

class ProductRepository implements ProductRepositoryInterface
{

    /**
     * @param array $data
     *
     * @return Collection
     */
    public function getAll(array $data): Collection
    {
        if (empty($data) || (count($data) === 1 && ! empty(HelperUtils::array_get($data, 'response_type', null)))) {
            return ProductModel::all();
        }

        $products = ProductModel::where(function ($q) use ($data) {
            if ( ! empty(HelperUtils::array_get($data, 'nome', null))) {
                $q->where('nome', 'like', "%{$data['nome']}%");
            }
            if ( ! empty(HelperUtils::array_get($data, 'codigo', null))) {
                $q->where('codigo', 'like', "%{$data['codigo']}%");
            }
            if ( ! empty(array_get($data, 'preco_unitario', 0))) {
                $q->where('preco_unitario', '=', $data['preco_unitario']);
            }
        })->get();

        return $products;

    }

    /**
     * @param string $id
     *
     * @return ProductModel|null
     */
    public function getById(string $id): ?ProductModel
    {
        $product = ProductModel::find($id);

        if (empty($product)) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::NOT_FOUND);
        }

        return $product;
    }

    /**
     * @param array $data
     *
     * @return ProductModel
     */
    public function create(array $data): ProductModel
    {
        return DB::transaction(function () use ($data) {

            $product = self::saveProduct($data);

            return $product;

        });
    }

    /**
     * @param array  $data
     * @param string $id
     *
     * @return ProductModel
     */
    public function update(array $data, string $id): ProductModel
    {
        return DB::transaction(function () use ($data, $id) {

            $product = self::saveProduct($data, $id);

            return $product;
        });
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function delete(string $id): bool
    {
        $product = ProductModel::destroy($id);

        if ( ! $product) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::NOT_FOUND);
        }

        return $product;
    }


    /**
     * @param array       $data
     * @param string|null $id
     *
     * @return ProductModel
     */
    private function saveProduct(array $data, ?string $id = null): ProductModel
    {
        if ( ! HelperUtils::validateFields($data, ['nome', 'codigo']) || empty(array_get($data, 'preco_unitario', 0))) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::DATA_IS_NULL);
        }

        $product = ProductModel::where('nome', $data['nome'])
                               ->orWhere('codigo', $data['codigo'])
                               ->first();

        if ($product instanceof ProductModel && $product->id != $id) {
            abort(HttpResponseStatusCodeEnum::BAD_REQUEST, ResponseEnum::ALREADY_EXISTS);
        }

        if (is_null($id)) {
            $product = new ProductModel();
        } elseif ( ! $product = ProductModel::find($id)) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::NOT_FOUND);
        }

        $product->codigo         = HelperUtils::array_get($data, 'codigo', $product->codigo ?: null);
        $product->nome           = HelperUtils::array_get($data, 'nome', $product->nome ?: null);
        $product->preco_unitario = HelperUtils::array_get($data, 'preco_unitario', $product->preco_unitario ?: null);
        $product->save();

        return $product;
    }
}