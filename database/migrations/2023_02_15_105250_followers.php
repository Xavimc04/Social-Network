<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up() {
        Schema::create('followers', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('follower');
            $table->unsignedBigInteger('user_id'); 

            $table->foreign('follower')->references('id')->on('users');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down() {
        Schema::dropIfExists('followers');
    }
};
