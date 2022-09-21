<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('status');
            $table->boolean('subjekt')->default(true)->comment('1=zasebnik 2=firma');
            $table->string('username', 128);
            $table->string('email_address');
            $table->integer('country_code')->nullable();
            $table->bigInteger('telefon')->nullable();
            $table->bigInteger('telefon2')->nullable();
            $table->string('tel_opis', 100)->nullable()->comment('cena za 090 številke');
            $table->string('tel2_opis', 100)->nullable();
            $table->integer('regija_id')->nullable()->index('regija_id')->comment('pošta');
            $table->string('naslov', 128)->nullable();
            $table->integer('num_oglasov')->default(0);
            $table->string('password', 255);
            $table->dateTime('account_created')->useCurrent();
            $table->dateTime('last_login')->nullable();
            $table->integer('number_logins')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
