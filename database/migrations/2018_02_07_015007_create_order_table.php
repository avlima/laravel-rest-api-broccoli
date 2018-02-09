<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->char('cliente', 36)
                  ->index('pedido_pessoa_id_foreign');
            $table->foreign('cliente')->references('id')->on('pessoa');
            $table->integer('numero', true, false);
            $table->date('emissao');
            $table->double('total', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pedido', function ($table) {
            $table->dropForeign('pedido_pessoa_id_foreign');
        });
        Schema::dropIfExists('pedido');
    }
}
