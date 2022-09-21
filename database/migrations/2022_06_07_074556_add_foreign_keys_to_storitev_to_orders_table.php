<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStoritevToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('storitev_to_orders', function (Blueprint $table) {
            $table->foreign(['o_cu_id'], 'storitev_to_orders_ibfk_1')->references(['id'])->on('orders')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('storitev_to_orders', function (Blueprint $table) {
            $table->dropForeign('storitev_to_orders_ibfk_1');
        });
    }
}
