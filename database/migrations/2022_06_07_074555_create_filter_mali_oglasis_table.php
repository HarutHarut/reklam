<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterMaliOglasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_mali_oglasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listing_id')->index('oglas_id')->comment('id oglasa');
            $table->unsignedBigInteger('f_id')->index('f_c_id')->comment('id filtra');
            $table->unsignedBigInteger('f_o_id')->index('f_c_o_id')->comment('seletced filter option');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filter_mali_oglasis');
    }
}
