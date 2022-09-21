<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaliOglasiKontaktsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mali_oglasi_kontakts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('listing_id')->index('add_id')->comment('****');
            $table->integer('country_code');
            $table->bigInteger('telefon');
            $table->string('kontakt_email')->comment('če je izpolnjen, izpiši');
            $table->integer('sms_verfied')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mali_oglasi_kontakts');
    }
}
