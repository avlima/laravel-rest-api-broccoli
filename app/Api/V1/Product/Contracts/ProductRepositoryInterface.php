<?php

namespace App\Api\V1\Product\Contracts;


use App\Api\V1\Product\Models\ProductModel;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{

    /**
     * @param array $data
     *
     * @return Collection
     */
    public function getAll(array $data): Collection;

    /**
     * @param string $id
     * @return ProductModel|null
     */
    public function getById(string $id): ?ProductModel;

    /**
     * @param array $data
     * @return ProductModel
     */
    public function create(array $data): ProductModel;

    /**
     * @param array $data
     * @param string $id
     * @return ProductModel
     */
    public function update(array $data, string $id): ProductModel;

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;
}