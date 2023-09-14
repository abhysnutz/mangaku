<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comic_id');
            $table->text('slug');
            $table->string('episode', 200)->nullable();
            $table->string('title', 200);
            $table->unsignedInteger('views')->default(0);
            $table->unsignedSmallInteger('order');
            $table->text('url');
            $table->timestamps();
            
            //relasi ke tabel comic
            $table->foreign('comic_id')->references('id')->on('comics')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('chapters');
    }
};