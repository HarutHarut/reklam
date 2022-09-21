<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMaliOglasiKontaktsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mali_oglasi_kontakts', function (Blueprint $table) {
            $table->foreign(['listing_id'], 'mali_oglasi_kontakts_ibfk_1')->references(['id'])->on('mali_oglasis')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mali_oglasi_kontakts', function (Blueprint $table) {
            $table->dropForeign('mali_oglasi_kontakts_ibfk_1');
        });
    }
}
