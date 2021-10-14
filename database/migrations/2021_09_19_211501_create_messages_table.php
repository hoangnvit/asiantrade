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
            $table->increments('id');
            
            $table->integer('sender_id')->unsigned();
            $table->integer('receiver_id')->unsigned();
            $table->text('message');
            $table->string('title');
            $table->boolean('read_status')->default(0);
            $table->boolean('display_sender')->default(1);
            $table->boolean('display_receiver')->default(1);
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
        Schema::dropIfExists('messages');
    }
}
