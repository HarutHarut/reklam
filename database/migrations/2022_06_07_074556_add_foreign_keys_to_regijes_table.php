<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToRegijesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('regijes', function (Blueprint $table) {
            $table->foreign(['country_id'], 'regijes_ibfk_1')->references(['id'])->on('countries')->onUpdate('CASCADE')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('regijes', function (Blueprint $table) {
            $table->dropForeign('regijes_ibfk_1');
        });
    }
}
