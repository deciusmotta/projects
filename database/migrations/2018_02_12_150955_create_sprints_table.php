<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSprintsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sprints', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->date('started_at');
            $table->date('ended_at');
            $table->date('released_at');
            $table->text('acceptance');
            $table->unsignedInteger('project_id');
            $table->timestamps();
        });

        Schema::table('sprints', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects');
        });

        Schema::create('sprint_task', function (Blueprint $table) {
            $table->unsignedInteger('sprint_id');
            $table->unsignedInteger('task_id');
        });

        Schema::table('sprint_task', function (Blueprint $table) {
            $table->foreign('sprint_id')->references('id')->on('sprints');
            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sprints');
    }
}
