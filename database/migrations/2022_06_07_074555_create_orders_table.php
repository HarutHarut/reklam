<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->dateTime('cu_datum')->useCurrent();
            $table->integer('cu_user');
            $table->integer('cu_company')->default(3)->comment('3=laprom');
            $table->integer('cu_subjekt')->default(0)->comment('0=fiz,1=prv');
            $table->string('cu_naziv', 150);
            $table->string('cu_telefon', 50);
            $table->string('cu_email', 40);
            $table->string('cu_naslov', 150);
            $table->string('cu_posta', 100);
            $table->string('cu_davcna', 16);
            $table->integer('cu_ureditev')->default(0)->comment('0=z ddv,1=tujina');
            $table->decimal('cu_ddv', 3, 1)->default(0);
            $table->string('cu_komentar', 500);
            $table->decimal('cu_znesek')->default(0)->comment('bruto za plačilo skupaj');
            $table->integer('cu_nacin_predplacila')->default(1)->comment('1=nakazilo,2=kartica,3=gotovina,4=paypal,5=sms,6=valu');
            $table->integer('cu_status_placila')->default(0)->comment('0=ni placano,1=placano,2=ara');
            $table->string('cu_ponudba', 20);
            $table->string('cu_racun', 20);
            $table->date('cu_date_racun');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
