<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorePermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        Schema::create('core_permission_role',function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('role_id');
            $table->unsignedInteger('permission_id');
            $table->tinyInteger('position')->default(1);

            $table->integer('created_by')->default(1);
            $table->integer('updated_by')->default(1);
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(array('role_id','permission_id'));
            $table->foreign('role_id')
                ->references('id')->on('core_roles')
                ->onDelete('restrict');
            $table->foreign('permission_id')
                ->references('id')->on('core_permissions')
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
        Schema::drop('core_permission_role');
        
    }
}
