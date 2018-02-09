<?php

namespace Tests\Feature;

use App\Api\V1\Person\Models\PersonModel;
use Carbon\Carbon;
use Tests\TestCase;

class PersonApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testApiGetById()
    {
        $response = $this->call('GET', '/api/v1/person/' . PersonModel::inRandomOrder()->first()->id);

        $this->assertEquals(200, $response->status());
    }

    public function testApiGetAll()
    {
        $response = $this->call('GET',
            '/api/v1/person?response_type=json&nome=w&cpf=046.216.689-94&data_nascimento=1984-08-27');

        $this->assertEquals(200, $response->status());
    }

    public function testApiCreate()
    {
        $response = $this->call('POST', '/api/v1/person', [
            'nome'            => 'Beto Lima' . rand(1, 999999),
            'cpf'             => '046.216.689-94',
            'data_nascimento' => Carbon::now()->format('Y-m-d')
        ]);

        $this->assertEquals(201, $response->status());
    }

    public function testApiUpdate()
    {
        $response = $this->call('PUT', '/api/v1/person/' . PersonModel::inRandomOrder()->first()->id, [
            'nome'            => 'Diego Theo' . rand(1, 999999),
            'cpf'             => '046.216.689-94',
            'data_nascimento' => Carbon::now()->format('Y-m-d'),
        ]);

        $this->assertEquals(200, $response->status());
    }

    public function testApiDelete()
    {
        $person                  = new PersonModel();
        $person->nome            = 'Carlos Theo' . rand(1, 999999);
        $person->cpf             = '046.216.689-94';
        $person->data_nascimento = Carbon::now()->format('Y-m-d');
        $person->save();

        $response = $this->call('DELETE', '/api/v1/person/' . $person->id);

        $this->assertEquals(204, $response->status());
    }
}
