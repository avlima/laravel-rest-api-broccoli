<?php

use App\Api\V1\Order\Models\OrderItemModel;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OrderItemModel::class, 5)->create();
    }
}
