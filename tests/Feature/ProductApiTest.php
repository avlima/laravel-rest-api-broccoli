<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductApiTest extends TestCase
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

    public function testApiGet()
    {
        $response = $this->call('GET', '/api/v1/product');

        $this->assertEquals(200, $response->status());
    }

    public function testApiGetAll()
    {
        $response = $this->call('GET', '/api/v1/product?response_type=json&nome=a&codigo=3&preco_unitario=');

        $this->assertEquals(200, $response->status());
    }

    public function testApiCreate()
    {
        $response = $this->call('POST', '/api/v1/product', [
            'codigo' => '346X38811W',
            'nome' => 'Placa de rede',
            'preco_unitario' => 10,
        ]);

        $this->assertEquals(200, $response->status());
    }
}
