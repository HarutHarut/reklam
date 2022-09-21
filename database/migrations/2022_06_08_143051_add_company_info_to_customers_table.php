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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('company_name')->nullable()->after('password');
            $table->string('company_addr')->nullable()->after('password');
            $table->string('company_addr_post')->nullable()->after('password');
            $table->string('company_tax_number')->nullable()->after('password');
        });
    }
};
