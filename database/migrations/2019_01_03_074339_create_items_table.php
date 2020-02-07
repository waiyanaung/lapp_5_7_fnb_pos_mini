<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->unique();
            $table->integer('status')->default(1);
            $table->string('code')->nullable();
            $table->string('model')->nullable();

            $table->string('description',255)->nullable();
            $table->text('detail_info')->nullable();
            $table->string('remark')->nullable();

            $table->integer('category_id')->nullable();            
            $table->integer('brand_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->text('custom_features')->nullable();
            
            $table->string('image_url',255)->nullable()->default('');
            $table->text('image_encode')->nullable()->default('');

            $table->string('image_url1',255)->nullable()->default('');
            $table->text('image_encode1')->nullable()->default('');
                        
            $table->string('name_mm',255)->nullable();
            $table->string('name_jp',255)->nullable();
            $table->string('name_zh',255)->nullable();            
            
            $table->string('description_mm',255)->nullable();
            $table->string('description_jp',255)->nullable();
            $table->string('description_zh',255)->nullable();
            
            $table->text('detail_info_mm')->nullable();
            $table->text('detail_info_jp')->nullable();
            $table->text('detail_info_zh')->nullable();
            
            $table->string('remark_mm')->nullable();
            $table->string('remark_jp')->nullable();
            $table->string('remark_zh')->nullable();

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
        Schema::dropIfExists('items');
    }
}
