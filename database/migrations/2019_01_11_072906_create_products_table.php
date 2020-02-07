<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('products', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->string('code')->nullable();
        //     $table->integer('status')->default(1);            

        //     $table->double('price')->nullable();

        //     $table->string('image_url')->nullable()->default('');
        //     $table->text('image_encode')->nullable()->default('');
            
        //     $table->string('name', 255)->unique();
        //     $table->string('name_mm',255)->nullable();
        //     $table->string('name_jp',255)->nullable();
        //     $table->string('name_zh',255)->nullable();
            
        //     $table->string('detail_info')->nullable();
        //     $table->string('detail_info_mm')->nullable();
        //     $table->string('detail_info_jp')->nullable();
        //     $table->string('detail_info_zh')->nullable();

        //     $table->string('remark')->nullable();
        //     $table->string('remark_mm')->nullable();
        //     $table->string('remark_jp')->nullable();
        //     $table->string('remark_zh')->nullable();

        //     $table->integer('created_by')->default(1);
        //     $table->integer('updated_by')->default(1);
        //     $table->integer('deleted_by')->nullable();
        //     $table->timestamps();
        //     $table->softDeletes();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
