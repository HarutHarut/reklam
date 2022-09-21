<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaidItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paid_items', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50);
            $table->decimal('price', 5)->default(0);
            $table->integer('user_tip')->comment('1=fiz;2=pravna; Komu je paket na voljo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paid_items');
    }
}
