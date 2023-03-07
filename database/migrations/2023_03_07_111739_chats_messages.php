<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('sender_id'); 
            $table->unsignedBigInteger('chat_id'); 
            $table->longText('message'); 
            $table->timestamps();

            $table->foreign('sender_id')->references('id')->on('users');
            $table->foreign('chat_id')->references('id')->on('chats');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chat_messages');
    }
};
