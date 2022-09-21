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
        Schema::table('paid_items', function (Blueprint $table) {
            $table->boolean('images_and_contact')->default(0)->after('price');
            $table->boolean('filters_show')->default(0)->after('images_and_contact');
            $table->boolean('course')->default(0)->after('filters_show');
            $table->boolean('statistics')->default(0)->after('course');
            $table->boolean('listing_count')->nullable()->after('statistics');
            $table->boolean('expiry_date')->nullable()->after('listing_count');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paid_items', function (Blueprint $table) {
            //
        });
    }
};
