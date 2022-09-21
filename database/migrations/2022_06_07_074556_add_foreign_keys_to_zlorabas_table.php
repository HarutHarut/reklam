<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToZlorabasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('zlorabas', function (Blueprint $table) {
            $table->foreign(['id_oglasa'], 'zlorabas_ibfk_1')->references(['id'])->on('mali_oglasis')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('zlorabas', function (Blueprint $table) {
            $table->dropForeign('zlorabas_ibfk_1');
        });
    }
}
