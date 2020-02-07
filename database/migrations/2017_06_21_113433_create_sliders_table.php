<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->integer('template_id');
            $table->integer('status')->default(1);

            $table->string('name', 255)->nullable();
            $table->string('name_mm',255)->nullable();
            $table->string('name_jp',255)->nullable();
            $table->string('name_zh',255)->nullable();
            
            $table->string('image_url', 45);
            $table->string('defatult_image')->nullable();

            $table->string('title', 45);
            $table->string('title_jp', 45)->nullable();
            $table->string('title_mm', 45)->nullable();
            $table->string('title_zh', 45)->nullable();

            $table->string('description', 255);
            $table->string('description_jp', 255)->nullable();
            $table->string('description_mm', 255)->nullable();
            $table->string('description_zh', 255)->nullable();

            $table->text('detail_info')->nullable();
            $table->text('detail_info_mm')->nullable();
            $table->text('detail_info_jp')->nullable();
            $table->text('detail_info_zh')->nullable();           

            //-------common to all tables--------
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
        Schema::drop('sliders');
    }
}
