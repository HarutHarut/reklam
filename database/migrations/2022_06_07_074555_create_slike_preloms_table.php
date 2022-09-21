<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlikePrelomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slike_preloms', function (Blueprint $table) {
            $table->id();
            $table->integer('oglasnik')->comment('1=kommers,2=agro');
            $table->integer('rubrika');
            $table->integer('oglas_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('slike_preloms');
    }
}
