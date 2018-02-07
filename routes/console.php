<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('create-db', function () {
    try {
        if (DB::statement('CREATE DATABASE uds_desafio CHARACTER SET utf8 COLLATE utf8_general_ci;')) {
            $path = base_path('.env');

            if (file_exists($path)) {
                file_put_contents($path, str_replace(
                    'DB_DATABASE=', 'DB_DATABASE=uds_desafio', file_get_contents($path)
                ));
            }
            $this->comment('Successfully created database');
        }
    } catch (\Exception $e) {
        $this->comment($e->getMessage());
    }

})->describe('Create database');
