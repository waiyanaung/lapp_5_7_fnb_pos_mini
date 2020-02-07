<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('name_mm')->nullable();
            $table->string('name_jp')->nullable();
            $table->string('name_zh')->nullable();
            $table->text('description')->nullable();
            $table->text('description_mm')->nullable();
            $table->text('description_jp')->nullable();
            $table->text('description_zh')->nullable();
            $table->text('content');
            $table->string('status');
            $table->string('url');
            $table->string('title');
            $table->integer('page_menu_order');
            $table->integer('events_id');
            $table->integer('templates_id');

            //Common to all table ----------------------------------------------
            $table->string('created_by',100)->nullable();
            $table->string('updated_by',100)->nullable();
            $table->string('deleted_by',100)->nullable();
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
         Schema::drop('pages');
    }
}
