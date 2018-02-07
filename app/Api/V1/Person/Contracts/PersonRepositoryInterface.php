<?php

namespace App\Api\V1\Person\Contracts;


use App\Api\V1\Person\Models\PersonModel;

interface PersonRepositoryInterface
{
    /**
     * @param array $data
     * @return PersonModel
     */
    public function create(array $data): PersonModel;

    /**
     * @param array $data
     * @param int $id
     * @return PersonModel
     */
    public function update(array $data, int $id): PersonModel;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}