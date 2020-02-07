<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteConfigsTables extends Migration
{
    
    public function up()
    {
        Schema::create('site_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('commercial_tax')->nullable();
            $table->integer('service_tax')->nullable();

            $table->integer('created_by')->default(1);
            $table->integer('updated_by')->default(1);
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
        });
    }

   
    public function down()
    {
        Schema::drop('site_configs');
    }
}
