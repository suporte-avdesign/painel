<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentBilletsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_billets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('payment_company_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->smallInteger('method_payment');
            $table->smallInteger('status');
            $table->string('status_label', 50);
            $table->string('reference')->unique();
            $table->string('code')->unique();
            $table->decimal('value',8, 2);
            $table->text('link');
            $table->date('date');
            $table->date('date_refersh_status')->nullable();
            $table->timestamps();

            $table->foreign('payment_company_id')->references('id')
                ->on('payment_companies')->onDelete('cascade');

            $table->foreign('order_id')->references('id')
                ->on('orders')->onDelete('cascade');

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_billets');
    }
}
