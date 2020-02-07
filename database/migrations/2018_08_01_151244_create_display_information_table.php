<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDisplayInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('display_information', function (Blueprint $table) {
            // $table->increments('id');
            $table->string('type');
            $table->longText('text_en')->nullable();
            $table->longText('text_jp')->nullable();
            $table->longText('text_mm')->nullable();
            $table->longText('text_zh')->nullable();

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
        Schema::drop('display_information');
    }
}
