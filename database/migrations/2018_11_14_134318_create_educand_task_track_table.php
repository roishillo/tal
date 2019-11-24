<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducandTaskTrackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educand_task_tracks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('educand_id');
            $table->unsignedInteger('track_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->integer('help_count');
            $table->integer('item_id')->nullable();
            $table->string('item_type')->nullable();
            $table->timestamps();

            $table->foreign('educand_id')->references('id')
                ->on('educands')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('track_id')->references('id')
                ->on('tracks')->onUpdate('RESTRICT')->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('educands', function (Blueprint $table) {
            $table->dropForeign(['educand_id']);
            $table->dropForeign(['track_id']);
        });

        Schema::dropIfExists('educand_task_tracks');
    }
}
