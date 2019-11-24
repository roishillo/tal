<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name1');
            $table->string('full_name2');
            $table->text('about_me')->nullable();
            $table->string('address');
            $table->string('contact_first_name');
            $table->string('contact_last_name');
            $table->string('contact_last_email');
            $table->string('contact_last_phone');
            $table->unsignedInteger('disability_level')->default(0);
            $table->string('gender');
            $table->string('visual_resource_path');
            $table->string('current_state');
            $table->date('birth_date');
            $table->string('qr_instructions_path');
            $table->unsignedInteger('track_id')->nullable();
            $table->unsignedInteger('admin_id');

            $table->foreign('admin_id')->references('id')
                ->on('admins')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('track_id')->references('id')
                ->on('tracks')->onUpdate('RESTRICT')->onDelete('RESTRICT');

            $table->timestamps();
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
            $table->dropForeign(['admin_id']);
            $table->dropForeign(['track_id']);
        });


        Schema::dropIfExists('educands');
    }
}
