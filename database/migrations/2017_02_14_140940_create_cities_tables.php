<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTables extends Migration
{
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('status')->default(1);
            $table->unsignedInteger('country_id');
            $table->string('code')->nullable();

            $table->string('name', 255)->unique();
            $table->string('name_mm',255)->nullable();
            $table->string('name_jp',255)->nullable();
            $table->string('name_zh',255)->nullable();
            
            $table->string('image_url')->nullable()->default('');
            $table->text('image_encode')->nullable()->default('');            

            $table->string('description')->nullable();
            $table->string('description_mm')->nullable();
            $table->string('description_jp')->nullable();
            $table->string('description_zh')->nullable();

            $table->string('remark')->nullable();
            $table->string('remark_mm')->nullable();
            $table->string('remark_jp')->nullable();
            $table->string('remark_zh')->nullable();

            $table->text('detail_info')->nullable();
            $table->text('detail_info_mm')->nullable();
            $table->text('detail_info_jp')->nullable();
            $table->text('detail_info_zh')->nullable();            

            $table->integer('created_by')->default(1);
            $table->integer('updated_by')->default(1);
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('country_id')
            //     ->references('id')->on('countries')
            //     ->onDelete('restrict');
            
        });
    }


    public function down()
    {
        Schema::drop('cities');
    }
}
