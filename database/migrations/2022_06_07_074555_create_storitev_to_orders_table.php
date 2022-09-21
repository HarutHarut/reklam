<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoritevToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storitev_to_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('o_cu_id')->index('o_cu_id');
            $table->text('o_naziv');
            $table->decimal('o_cena', 10, 4)->default(0);
            $table->integer('o_item_id')->comment('id storitve nakupa');
            $table->integer('o_listing_id');
            $table->integer('o_kolicina')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('storitev_to_orders');
    }
}
