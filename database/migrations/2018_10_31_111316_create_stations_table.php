<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('site_id');
            $table->string('name');
            $table->text('description');
            $table->string('visual_resource_path');
            $table->float('order');
            $table->boolean('is_public')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('admin_id');
            $table->timestamps();

            $table->foreign('site_id')->references('id')
                ->on('sites')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
        Schema::table('stations', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
            $table->dropForeign(['site_id']);
        });

        Schema::dropIfExists('stations');
    }
}
