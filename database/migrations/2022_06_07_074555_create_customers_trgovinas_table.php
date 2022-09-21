<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTrgovinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_trgovinas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('c_id')->index('customers_id');
            $table->string('tocen_naziv', 128);
            $table->integer('davcna');
            $table->text('trgovina_opis');
            $table->string('slogan');
            $table->string('delovni_cas', 128);
            $table->string('nacin_prevzema', 128);
            $table->string('spletna_stran', 128);
            $table->unsignedBigInteger('category_id')->index('category_id');
            $table->string('logo', 20);
            $table->string('xml_uvoz');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers_trgovinas');
    }
}
