<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsPagseguroTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_pagseguro', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->smallInteger('status');
            $table->string('status_label', 50);
            $table->text('status_descriprion');
            $table->smallInteger('method_payment');
            $table->string('brand')->nullable();
            $table->integer('card_number')->nullable();
            $table->smallInteger('date_month')->nullable();
            $table->smallInteger('date_year')->nullable();
            $table->smallInteger('card_cvv')->nullable();
            $table->smallInteger('parcels')->nullable();
            $table->string('reference')->unique();
            $table->string('code')->unique();
            $table->decimal('value',8, 2);
            $table->date('date');
            $table->date('date_refersh_status')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('payments_pagseguro');
    }
}
