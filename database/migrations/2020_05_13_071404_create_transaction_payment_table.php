<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_payment', function (Blueprint $table) {
            $table->string('id', 30)->primary();
            $table->string('transaction_id', 30);
            $table->integer('status')->default(1);
            $table->date('date')->nullable();
            
            $table->integer('payment_type')->default(1);            
            $table->decimal('paid_amt',10,2)->nullable();
            $table->decimal('change_amt',10,2)->nullable();
            $table->string('bank_reference',100)->nullable();
            $table->string('remark',255)->nullable();

            $table->integer('created_by')->default(1);
            $table->integer('updated_by')->default(1);
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction_payment');
    }
}
