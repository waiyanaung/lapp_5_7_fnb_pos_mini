<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('expense_type_id');
            $table->integer('status')->default(1);
            $table->date('date')->nullable();
            $table->decimal('amount',10,2)->nullable();

            $table->string('name', 255)->unique();
            $table->string('name_mm',255)->nullable();
            $table->string('name_jp',255)->nullable();
            $table->string('name_zh',255)->nullable();

            $table->string('image_url')->nullable()->default('');
            $table->text('image_encode')->nullable()->default('');

            $table->string('image_url1')->nullable()->default('');
            $table->text('image_encode1')->nullable()->default('');

            $table->string('description')->nullable();
            $table->string('description_mm')->nullable();
            $table->string('description_jp')->nullable();
            $table->string('description_zh')->nullable();

            $table->string('remark')->nullable();
            $table->string('remark_mm')->nullable();
            $table->string('remark_jp')->nullable();
            $table->string('remark_zh')->nullable();

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
        Schema::dropIfExists('expenses');
    }
}