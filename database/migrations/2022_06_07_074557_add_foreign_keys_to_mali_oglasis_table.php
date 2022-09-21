<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMaliOglasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mali_oglasis', function (Blueprint $table) {
            $table->foreign(['user_id'], 'mali_oglasis_ibfk_1')->references(['id'])->on('customers')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['regija_id'], 'mali_oglasis_ibfk_2')->references(['id'])->on('regijes')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign(['tip0'], 'mali_oglasis_ibfk_3')->references(['id'])->on('kategorijes')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign(['tip1'], 'mali_oglasis_ibfk_4')->references(['id'])->on('kategorijes')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign(['tip_id'], 'mali_oglasis_ibfk_5')->references(['id'])->on('kategorijes')->onUpdate('CASCADE')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mali_oglasis', function (Blueprint $table) {
            $table->dropForeign('mali_oglasis_ibfk_1');
            $table->dropForeign('mali_oglasis_ibfk_2');
            $table->dropForeign('mali_oglasis_ibfk_3');
            $table->dropForeign('mali_oglasis_ibfk_4');
            $table->dropForeign('mali_oglasis_ibfk_5');
        });
    }
}
