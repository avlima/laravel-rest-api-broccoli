<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_pedido', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->primary('id');
            $table->char('produto', 36)
                  ->index('item_pedido_produto_id_foreign');
            $table->foreign('produto')->references('id')->on('produto');
            $table->double('preco_unitario', 8, 2);
            $table->double('desconto', 8, 2);
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
        Schema::table('item_pedido', function ($table) {
            $table->dropForeign('item_pedido_produto_id_foreign');
        });
        Schema::dropIfExists('item_pedido');
    }
}
