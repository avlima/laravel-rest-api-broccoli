<?php

namespace Tests\Feature;

use App\Api\V1\Order\Models\OrderModel;
use App\Api\V1\Person\Models\PersonModel;
use App\Api\V1\Product\Models\ProductModel;
use Carbon\Carbon;
use Tests\TestCase;

class OrderApiTest extends TestCase
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
        $response = $this->call('GET', '/api/v1/order/' . OrderModel::inRandomOrder()->first()->id);

        $this->assertEquals(200, $response->status());
    }

    public function testApiGetAll()
    {
        $response = $this->call('GET',
            '/api/v1/order?response_type=json&numero=2&total=95&emissao=&pessoa=wil&produto=');

        $this->assertEquals(200, $response->status());
    }

    public function testApiCreate()
    {
        $response = $this->call('POST', '/api/v1/order', [
            'emissao' => Carbon::now()->format('Y-m-d'),
            'pessoa'  => [
                'id' => PersonModel::inRandomOrder()->first()->id
            ],
            'item'    => [
                [
                    'id'       => ProductModel::inRandomOrder()->first()->id,
                    'desconto' => rand(0, 50),
                ]
            ]
        ]);

        $this->assertEquals(201, $response->status());
    }

    public function testApiUpdate()
    {
        $response = $this->call('PUT', '/api/v1/order/' . OrderModel::inRandomOrder()->first()->id, [
            'emissao' => Carbon::now()->format('Y-m-d'),
            'pessoa'  => [
                'id' => PersonModel::inRandomOrder()->first()->id
            ],
            'item'    => [
                [
                    'id'       => ProductModel::inRandomOrder()->first()->id,
                    'desconto' => rand(0, 50),
                ]
            ]
        ]);

        $this->assertEquals(200, $response->status());
    }

    public function testApiDelete()
    {
        $order          = new OrderModel();
        $order->cliente = PersonModel::inRandomOrder()->first()->id;
        $order->emissao = Carbon::now()->format('Y-m-d');
        $order->total   = 100;
        $order->save();

        $response = $this->call('DELETE', '/api/v1/order/' . $order->id);

        $this->assertEquals(204, $response->status());
    }
}
