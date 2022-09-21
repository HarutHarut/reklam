<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToKategorijesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kategorijes', function (Blueprint $table) {
            $table->foreign(['parent_id'], 'kategorijes_ibfk_1')->references(['id'])->on('kategorijes')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kategorijes', function (Blueprint $table) {
            $table->dropForeign('kategorijes_ibfk_1');
        });
    }
}
