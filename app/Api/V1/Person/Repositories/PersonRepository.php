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
     * @param array $data
     *
     * @return Collection
     */
    public function getAll(array $data): Collection
    {
        if (empty($data) || (count($data) === 1 && ! empty(HelperUtils::array_get($data, 'response_type', null)))) {
            return PersonModel::all();
        }

        $persons = PersonModel::where(function ($q) use ($data) {
            if ( ! empty(HelperUtils::array_get($data, 'nome', null))) {
                $q->where('nome', 'like', "%{$data['nome']}%");
            }
            if ( ! empty(HelperUtils::array_get($data, 'cpf', null)) && NumberUtils::formatCpf($data['cpf'])) {
                $q->where('cpf', '=', NumberUtils::formatCpf($data['cpf']));
            }
            if ( ! empty(HelperUtils::array_get($data, 'data_nascimento', null))) {
                $q->where('data_nascimento', '=', $data['data_nascimento']);
            }
        })->get();

        return $persons;

    }

    /**
     * @param string $id
     *
     * @return PersonModel|null
     */
    public function getById(string $id): ?PersonModel
    {
        $person = PersonModel::find($id);

        if (empty($person)) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::NOT_FOUND);
        }

        return $person;
    }

    /**
     * @param array $data
     *
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
     * @param array  $data
     * @param string $id
     *
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
     *
     * @return bool
     */
    public function delete(string $id): bool
    {
        $person = PersonModel::destroy($id);

        if ( ! $person) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::NOT_FOUND);
        }

        return $person;
    }


    /**
     * @param array       $data
     * @param string|null $id
     *
     * @return PersonModel
     */
    private function savePerson(array $data, ?string $id = null): PersonModel
    {
        if ( ! HelperUtils::validateFields($data, ['nome', 'cpf', 'data_nascimento'])) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::DATA_IS_NULL);
        }

        if ( ! NumberUtils::validateCpf($data['cpf'])) {
            abort(HttpResponseStatusCodeEnum::BAD_REQUEST, ResponseEnum::DOCUMENT_NOT_VALID);
        }

        $person = PersonModel::where('nome', $data['nome'])->first();

        if ($person instanceof PersonModel && $person->id != $id) {
            abort(HttpResponseStatusCodeEnum::BAD_REQUEST, ResponseEnum::ALREADY_EXISTS);
        }

        if (is_null($id)) {
            $person = new PersonModel();
        } elseif ( ! $person = PersonModel::find($id)) {
            abort(HttpResponseStatusCodeEnum::NOT_FOUND, ResponseEnum::NOT_FOUND);
        }

        $person->nome            = HelperUtils::array_get($data, 'nome', $person->nome ?: null);
        $person->cpf             = HelperUtils::array_get($data, 'cpf', $person->cpf ?: null);
        $person->data_nascimento = HelperUtils::array_get($data, 'data_nascimento', $person->data_nascimento ?: null);
        $person->save();

        return $person;
    }
}