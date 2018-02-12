<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('resource_role', function(Blueprint $table){
            $table->unsignedInteger('resource_id');
            $table->unsignedInteger('role_id');
        });

        Schema::table('resource_role', function(Blueprint $table){
            $table->foreign('resource_id')->references('id')->on('resources');
            $table->foreign('role_id')->references('id')->on('roles');
        });
        Schema::create('role_user', function(Blueprint $table){
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('role_id');
        });
        Schema::table('role_user', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
