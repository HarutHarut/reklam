<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kategorijes', function (Blueprint $table) {
            $table->dropColumn('color');
            $table->string('color_filters')->after('slug');
            $table->string('color_dropdown')->after('color_filters');
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
            //
        });
    }
};
