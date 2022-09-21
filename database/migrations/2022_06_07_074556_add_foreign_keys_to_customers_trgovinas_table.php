<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCustomersTrgovinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers_trgovinas', function (Blueprint $table) {
            $table->foreign(['category_id'], 'customers_trgovinas_ibfk_1')->references(['id'])->on('customers_categories')->onUpdate('CASCADE')->onDelete('NO ACTION');
            $table->foreign(['c_id'], 'customers_trgovinas_ibfk_2')->references(['id'])->on('customers')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers_trgovinas', function (Blueprint $table) {
            $table->dropForeign('customers_trgovinas_ibfk_1');
            $table->dropForeign('customers_trgovinas_ibfk_2');
        });
    }
}
