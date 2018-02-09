<?php

use App\Api\V1\Person\Models\ProductModel;
use Illuminate\Database\Seeder;

class PersonTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ProductModel::class, 5)->create();
    }
}
