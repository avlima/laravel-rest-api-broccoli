<?php

use App\Api\V1\Person\Models\PersonModel;
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
        factory(PersonModel::class, 5)->create();
    }
}
