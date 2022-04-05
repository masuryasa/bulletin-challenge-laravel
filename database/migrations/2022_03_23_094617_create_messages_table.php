<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_id')->nullable();
            $table->string('title');
            $table->string('body');
            $table->string('password')->nullable();
            $table->string('image_path')->nullable();
            $table->string('image_name')->nullable();
            $table->string('date');
            $table->string('time');
            $table->timestamps();
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn(['date', 'time']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
