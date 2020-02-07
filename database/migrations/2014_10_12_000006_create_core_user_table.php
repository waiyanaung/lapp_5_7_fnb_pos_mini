<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('user_name', 255)->unique();
            $table->string('password', 64);
            $table->string('email')->unique();
            $table->string('description')->nullable();
            $table->string('display_name_mm')->nullable();
            $table->string('display_name_jp')->nullable();
            $table->string('display_name_zh')->nullable();
            $table->string('display_name')->nullable();
            $table->string('display_image')->nullable()->default('/assets/images/generals/image_user_dp_default.png');
            $table->unsignedInteger('role_id');
            $table->text('about_me');
            $table->text('address');
            $table->integer('gender')->default(1);

            $table->integer('country_id')->default('117');
            $table->string('language',10)->default('en');
            $table->integer('status')->default(1);
            $table->dateTime('last_activity')->nullable();
            $table->rememberToken();

            $table->integer('created_by')->default(1);
            $table->integer('updated_by')->default(1);
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('role_id')
                ->references('id')->on('core_roles')
                ->onDelete('restrict');
        });
   
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {        
        Schema::drop('core_users');
    }
}
