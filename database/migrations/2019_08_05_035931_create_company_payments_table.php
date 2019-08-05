<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_payments', function (Blueprint $table) {
            $table->integer('id');
            $table->string('billet',30)->nullable();
            $table->string('cash',30)->nullable();
            $table->string('credit_card',30)->nullable();
            $table->string('debit_account',30)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_payments');
    }
}
