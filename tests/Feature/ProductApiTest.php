<?php

namespace Tests\Feature;

use App\Api\V1\Product\Models\ProductModel;
use Tests\TestCase;

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

    public function testApiGetById()
    {
        $response = $this->call('GET', '/api/v1/product/' . ProductModel::inRandomOrder()->first()->id);

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
            'codigo'         => rand(1, 999999),
            'nome'           => 'Produto numero' . rand(1, 9999),
            'preco_unitario' => 10,
        ]);

        $this->assertEquals(201, $response->status());
    }

    public function testApiUpdate()
    {
        $response = $this->call('PUT', '/api/v1/product/' . ProductModel::inRandomOrder()->first()->id, [
            'codigo'         => rand(1, 9999),
            'nome'           => 'Produto numero' . rand(1, 9999),
            'preco_unitario' => 10,
        ]);

        $this->assertEquals(200, $response->status());
    }

    public function testApiDelete()
    {
        $product                 = new ProductModel();
        $product->codigo         = rand(1, 9999);
        $product->nome           = 'Produto numero' . rand(1, 9999);
        $product->preco_unitario = 10;
        $product->save();

        $response = $this->call('DELETE', '/api/v1/product/' . $product->id);

        $this->assertEquals(204, $response->status());
    }
}
