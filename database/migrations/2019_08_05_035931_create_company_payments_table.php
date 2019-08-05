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
            $table->bigIncrements('id');
            $table->string('name',30)->nullable();
            $table->string('slug',30)->nullable();
            $table->smallInteger('billet')->default(0);
            $table->smallInteger('cash')->default(0);
            $table->smallInteger('credit_card')->default(0);
            $table->smallInteger('debit_card')->default(0);
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
