<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('id', 30)->primary();
            $table->integer('status')->default(1);
            $table->date('date');
            $table->string('remark')->nullable();

            $table->integer('customer_id')->nullable();            
            $table->integer('total_item_qty')->nullable();
            $table->decimal('sub_total',10,2)->nullable();                        
            $table->decimal('service_charges',10,2)->nullable();
            $table->decimal('tax_percent',8,2)->nullable();
            $table->integer('tax_type')->nullable();
            $table->decimal('tax_amt',10,2)->nullable();
            $table->integer('main_discount_type')->nullable();
            $table->decimal('main_discounts',10,2)->nullable();
            $table->decimal('total_item_discounts',10,2)->nullable();
            $table->decimal('grand_total',10,2)->nullable();

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
        Schema::dropIfExists('transactions');
    }
}
