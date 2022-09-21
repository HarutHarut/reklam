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
            $table->string('icon')->nullable()->after('tip');
            $table->string('color')->nullable()->after('tip');
            $table->string('slug')->unique()->after('tip');
        });
    }
};
