<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToListingSavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listing_saves', function (Blueprint $table) {
            $table->foreign(['customer_id'], 'listing_saves_ibfk_1')->references(['id'])->on('customers')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['listing_id'], 'listing_saves_ibfk_2')->references(['id'])->on('mali_oglasis')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listing_saves', function (Blueprint $table) {
            $table->dropForeign('listing_saves_ibfk_1');
            $table->dropForeign('listing_saves_ibfk_2');
        });
    }
}
