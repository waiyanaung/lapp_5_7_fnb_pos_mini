<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNrcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nrc', function (Blueprint $table) {
          
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('nrc_division');
            $table->string('nrc_national',10);
            $table->string('nrc_township1',10);
            $table->string('nrc_township2',10);
            $table->string('nrc_township3',10);
            $table->string('nrc_number',50);
            $table->integer('status')->default(1);

            //common to all tables...
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
         Schema::dropIfExists('nrc');
    }
}
