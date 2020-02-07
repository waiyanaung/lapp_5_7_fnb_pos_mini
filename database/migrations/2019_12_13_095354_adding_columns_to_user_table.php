<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingColumnsToUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('core_users', function (Blueprint $table) {
            $table->string('phone', 255)->after('email')->unique();
            $table->date('dob')->after('phone')->nullable();
            $table->string('first_name',50)->after('dob')->nullable();
            $table->string('last_name',50)->after('first_name')->nullable();
            $table->string('activation_code',50)->after('status')->nullable();
            $table->boolean('confirm')->after('activation_code')->default(0);
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('core_users', function (Blueprint $table) {
            $table->dropColumn(['phone']);
            $table->dropColumn(['dob']);
            $table->dropColumn(['first_name']);
            $table->dropColumn(['last_name']);
        });
    }
}
