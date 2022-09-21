<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('ime', 50);
            $table->string('priimek', 50);
            $table->integer('level')->comment('1=skrbnik, 2=administrator');
            $table->integer('podjetje')->default(3)->comment('3=laprom, 4=elektro-ton');
            $table->string('geslo', 30);
            $table->dateTime('datum')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
