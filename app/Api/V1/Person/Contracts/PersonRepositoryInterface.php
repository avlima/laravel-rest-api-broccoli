<?php

namespace App\Api\V1\Person\Contracts;


use App\Api\V1\Person\Models\PersonModel;
use Illuminate\Database\Eloquent\Collection;

interface PersonRepositoryInterface
{

    /**
     * @return Collection
     */
    public function getAll(): Collection;

    /**
     * @param string $uuid
     * @return PersonModel|null
     */
    public function getByUuid(string $uuid): ?PersonModel;

    /**
     * @param array $data
     * @return PersonModel
     */
    public function create(array $data): PersonModel;

    /**
     * @param array $data
     * @param string $uuid
     * @return PersonModel
     */
    public function update(array $data, string $uuid): PersonModel;

    /**
     * @param string $uuid
     * @return bool
     */
    public function delete(string $uuid): bool;
}