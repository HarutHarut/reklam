<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFiltersOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('filters_options', function (Blueprint $table) {
            $table->foreign(['f_id'], 'filters_options_ibfk_1')->references(['id'])->on('filters')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filters_options', function (Blueprint $table) {
            $table->dropForeign('filters_options_ibfk_1');
        });
    }
}
