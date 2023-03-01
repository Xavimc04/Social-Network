<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{ 
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); 
            $table->integer('user_id');
            $table->integer('category_id')->default(0); 
            $table->longText('content');
            $table->longText('file_route')->nullable(); 
            $table->longText('likes')->nullable(); 
            $table->timestamps();   
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
