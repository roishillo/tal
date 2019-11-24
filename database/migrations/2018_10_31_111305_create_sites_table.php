<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('address');
            $table->string('web_link');
            $table->string('visual_resource_path');
            $table->string('audio_resource_path');
            $table->string('helper_name');
            $table->string('helper_phone');
            $table->string('helper_phone_whatsapp');
            $table->string('helper_phone_audio_path');
            $table->string('wifi_name');
            $table->string('wifi_password');
            $table->integer('predicted_stations')->default(0);
            $table->boolean('is_public')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('admin_id');
            $table->timestamps();

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
        Schema::table('sites', function (Blueprint $table) {
            $table->dropForeign(['admin_id']);
        });

        Schema::dropIfExists('sites');
    }
}
