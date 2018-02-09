<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableOrderItemSetCascadePedido extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_pedido', function (Blueprint $table) {
            $table->dropForeign('item_pedido_pedido_foreign');
            $table->foreign('pedido')->references('id')->on('pedido')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_pedido', function (Blueprint $table) {
            $table->dropForeign('item_pedido_pedido_foreign');
            $table->dropColumn('pedido');
        });
    }
}
