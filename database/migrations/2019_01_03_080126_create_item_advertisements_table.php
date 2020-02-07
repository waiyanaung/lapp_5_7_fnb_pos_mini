<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_advertisements', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->nullable();
            $table->integer('item_id');
            $table->integer('status')->default(1);
            $table->string('image_url')->nullable()->default('');
            $table->text('image_encode')->nullable()->default('');

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
        // Schema::dropIfExists('item_advertisements');
    }
}
