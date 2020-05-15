<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransactionItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_item', function (Blueprint $table) {
            $table->string('id', 30)->primary();
            $table->string('transaction_id', 30);
            $table->integer('status')->default(1);            
            $table->integer('category_id')->nullable();            
            $table->integer('item_id')->nullable();
            $table->date('date')->nullable();
            
            $table->integer('item_qty')->nullable();
            $table->decimal('item_price',10,2)->nullable();
            $table->decimal('item_amt',10,2)->nullable();                        
            $table->integer('discount_type')->nullable();
            $table->decimal('discount_percent',10,2)->nullable();
            $table->decimal('discount_amt',10,2)->nullable();
            $table->decimal('sub_total_amt',10,2)->nullable();

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
        Schema::dropIfExists('transaction_item');
    }
}
