<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegijesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regijes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->index('country_id');
            $table->string('regija', 45)->index('regija');
            $table->unsignedBigInteger('parent_id')->default(0);
            $table->unsignedBigInteger('vrstni_red')->default(400)->index('vrstni_red');
            $table->string('postna_st', 6);
            $table->decimal('dolžina', 10);
            $table->decimal('širina', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regijes');
    }
}
