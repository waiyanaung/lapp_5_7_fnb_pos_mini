<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_order', function (Blueprint $table) {
            $table->string('id', 30)->primary();    
            $table->integer('status')->default(1);        
            $table->integer('customer_id')->nullable();
            $table->string('transaction_id', 30)->nullable();            
            $table->date('date');
            $table->tinyInteger('add_installation')->default(0);
            
            $table->string('name', 30)->nullable();  
            $table->string('phone', 30)->nullable();  
            $table->integer('township_id')->nullable();  
            $table->string('address', 255)->nullable();
             
            $table->string('remark', 255)->nullable();   
            $table->string('remark_customer', 255)->nullable();  

            $table->integer('item_id')->nullable();
            $table->integer('total_item_qty')->nullable();
            $table->decimal('item_price',10,2)->nullable();
            $table->decimal('total_item_price',10,2)->nullable();                        
            $table->integer('discount_type')->nullable();
            $table->decimal('discounts',10,2)->nullable();
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
        Schema::dropIfExists('transaction_order');
    }
}
