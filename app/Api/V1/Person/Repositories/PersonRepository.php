<?php

namespace App\Api\V1\Person\Repositories;


use App\Api\V1\Person\Contracts\PersonRepositoryInterface;
use App\Api\V1\Person\Models\PersonModel;
use App\Enum\HttpResponseStatusCodeEnum;
use App\Enum\ResponseEnum;
use App\Utils\HelperUtils;
use DB;

class PersonRepository implements PersonRepositoryInterface
{

    /**
     * @param array $data
     * @return PersonModel
     */
    public function create(array $data): PersonModel
    {
        return DB::transaction(function () use ($data) {

            $person = self::savePerson($data);

            return $person;

        });
    }

    /**
     * @param array $data
     * @param int $id
     * @return PersonModel
     */
    public function update(array $data, int $id): PersonModel
    {
        return DB::transaction(function () use ($data, $id) {

            $person = self::savePerson($data, $id);

            return $person;
        });
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }


    /**
     * @param array $data
     * @param int|null $id
     * @return PersonModel
     */
    private function savePerson(array $data, ?int $id = null): PersonModel
    {
        if (!HelperUtils::validateFields($data, ['nome'])) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::DATA_IS_NULL);
        }

        $person = PersonModel::where([
            ['nome', $data['nome']]
        ])->first();

        if ($person instanceof PersonModel && $person->id != $id) {
            abort(HttpResponseStatusCodeEnum::BAD_REQUEST, ResponseEnum::ALREADY_EXISTS);
        }

        if (is_null($id)) {
            $person = new PersonModel();
        } else if (!$person = PersonModel::find($id)) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::NOT_FOUND);
        }

        $person->nome = HelperUtils::array_get($data, 'nome', $person->nome ?: null);
        $person->save();

        return $person;
    }
}