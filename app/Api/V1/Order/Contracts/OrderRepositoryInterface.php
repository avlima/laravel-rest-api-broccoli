<?php

namespace App\Api\V1\Order\Contracts;


use App\Api\V1\Order\Models\OrderModel;
use Illuminate\Database\Eloquent\Collection;

interface OrderRepositoryInterface
{

    /**
     * @param array $data
     *
     * @return Collection
     */
    public function getAll(array $data): Collection;

    /**
     * @param string $id
     * @return OrderModel|null
     */
    public function getById(string $id): ?OrderModel;

    /**
     * @param array $data
     * @return OrderModel
     */
    public function create(array $data): OrderModel;

    /**
     * @param array $data
     * @param string $id
     * @return OrderModel
     */
    public function update(array $data, string $id): OrderModel;

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;
}