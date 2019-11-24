<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('station_id');
            $table->string('name');
            $table->text('description');
            $table->string('visual_resource_path');
            $table->string('audio_resource_path')->nullable();
            $table->float('order');
            $table->boolean('is_public')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('admin_id');
            $table->timestamps();

            $table->foreign('station_id')->references('id')
                ->on('stations')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('admin_id')->references('id')
                ->on('admins')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropForeign(['station_id']);
        });

        Schema::dropIfExists('tasks');
    }
}
