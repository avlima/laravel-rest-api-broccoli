<?php

namespace App\Api\V1\Person\Contracts;


use App\Api\V1\Person\Models\PersonModel;
use Illuminate\Database\Eloquent\Collection;

interface PersonRepositoryInterface
{

    /**
     * @param array $data
     *
     * @return Collection
     */
    public function getAll(array $data): Collection;

    /**
     * @param string $id
     *
     * @return PersonModel|null
     */
    public function getById(string $id): ?PersonModel;

    /**
     * @param array $data
     *
     * @return PersonModel
     */
    public function create(array $data): PersonModel;

    /**
     * @param array $data
     * @param string $id
     *
     * @return PersonModel
     */
    public function update(array $data, string $id): PersonModel;

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool;
}