<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToListingImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listing_images', function (Blueprint $table) {
            $table->foreign(['listing_id'], 'listing_images_ibfk_1')->references(['id'])->on('mali_oglasis')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listing_images', function (Blueprint $table) {
            $table->dropForeign('listing_images_ibfk_1');
        });
    }
}
