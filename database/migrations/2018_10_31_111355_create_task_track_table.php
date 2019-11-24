<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_track', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('task_id');
            $table->unsignedInteger('track_id');
            $table->float('order');
            $table->timestamps();

            $table->foreign('track_id')->references('id')
                ->on('tracks')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('task_id')->references('id')
                ->on('tasks')->onUpdate('RESTRICT')->onDelete('RESTRICT');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('task_track', function (Blueprint $table) {
            $table->dropForeign(['task_id']);
            $table->dropForeign(['track_id']);
        });

        Schema::dropIfExists('task_track');
    }
}
