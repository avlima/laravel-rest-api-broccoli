<?php

namespace App\Api\V1\Person\Repositories;


use App\Api\V1\Person\Contracts\PersonRepositoryInterface;
use App\Api\V1\Person\Models\PersonModel;
use App\Enum\HttpResponseStatusCodeEnum;
use App\Enum\ResponseEnum;
use App\Utils\HelperUtils;
use App\Utils\NumberUtils;
use DB;
use Illuminate\Database\Eloquent\Collection;

class PersonRepository implements PersonRepositoryInterface
{

    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return PersonModel::all();
    }

    /**
     * @param string $uuid
     * @return PersonModel|null
     */
    public function getByUuid(string $uuid): ?PersonModel
    {
        $person = PersonModel::find($uuid);

        if (empty($person)) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::NOT_FOUND);
        }

        return $person;
    }

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
     * @param string $id
     * @return PersonModel
     */
    public function update(array $data, string $id): PersonModel
    {
        return DB::transaction(function () use ($data, $id) {

            $person = self::savePerson($data, $id);

            return $person;
        });
    }

    /**
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        // TODO: Implement delete() method.
    }


    /**
     * @param array $data
     * @param string|null $id
     * @return PersonModel
     */
    private function savePerson(array $data, ?string $id = null): PersonModel
    {
        if (!HelperUtils::validateFields($data, ['nome', 'cpf', 'data_nascimento'])) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::DATA_IS_NULL);
        }

        if (NumberUtils::validateCpf($data['cpf'])) {
            abort(HttpResponseStatusCodeEnum::BAD_REQUEST, ResponseEnum::DOCUMENT_NOT_VALID);
        }

//        $person = PersonModel::where([
//            ['nome', $data['nome']]
//        ])->first();
//
//        if ($person instanceof PersonModel && $person->id != $id) {
//            abort(HttpResponseStatusCodeEnum::BAD_REQUEST, ResponseEnum::ALREADY_EXISTS);
//        }

        if (is_null($id)) {
            $person = new PersonModel();
        } else if (!$person = PersonModel::find($id)) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::NOT_FOUND);
        }

        $person->nome = HelperUtils::array_get($data, 'nome', $person->nome ?: null);
        $person->cpf = HelperUtils::array_get($data, 'cpf', $person->cpf ?: null);
        $person->data_nascimento = HelperUtils::array_get($data, 'data_nascimento', $person->data_nascimento ?: null);
        $person->save();

        return $person;
    }
}