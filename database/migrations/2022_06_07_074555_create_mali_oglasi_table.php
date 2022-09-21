<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaliOglasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mali_oglasi', function (Blueprint $table) {
            $table->integer('id', true);
            $table->boolean('status')->default(true)->comment('0=čaka 1=aktiven 2=potekel 3=zavrnjen 4=deaktiviran');
            $table->tinyInteger('tip_oglasa')->default(1)->comment('PRODAM = 1; KUPIM = 2; PODARIM = 5; NUDIM = 7; IŠČEM = 8');
            $table->integer('user_id')->default(0)->index('user_id')->comment('2 = brez prijave');
            $table->integer('tip0')->default(0)->index('tip0');
            $table->integer('tip1')->default(0)->index('tip1');
            $table->integer('tip2')->default(0);
            $table->integer('tip3')->default(0);
            $table->integer('tip4')->default(0);
            $table->integer('tip_id')->default(0)->index('tip_id')->comment('se odstrani ko se tipi prenesejo v tip0,1,2,3,4');
            $table->string('naslov', 80);
            $table->longText('opis');
            $table->string('keywords', 150)->comment('to so filtri');
            $table->decimal('cena', 10)->default(0);
            $table->integer('regija_id')->index('regija_id');
            $table->dateTime('date_sort')->useCurrent()->comment('datum za sortiranje oglasov in izpostavitev');
            $table->dateTime('datum_vnosa')->useCurrent();
            $table->dateTime('datum_spremembe')->useCurrent();
            $table->dateTime('datum_poteka');
            $table->dateTime('datum_poslanega_opozorila');
            $table->string('sifra', 30)->comment('bolha id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mali_oglasi');
    }
}
