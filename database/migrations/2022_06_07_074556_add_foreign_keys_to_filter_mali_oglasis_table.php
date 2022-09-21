<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFilterMaliOglasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filter_mali_oglasis', function (Blueprint $table) {
            $table->foreign(['f_id'], 'filter_mali_oglasis_ibfk_1')->references(['id'])->on('filters')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign(['listing_id'], 'filter_mali_oglasis_ibfk_2')->references(['id'])->on('mali_oglasis')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filter_mali_oglasis', function (Blueprint $table) {
            $table->dropForeign('filter_mali_oglasis_ibfk_1');
            $table->dropForeign('filter_mali_oglasis_ibfk_2');
        });
    }
}
