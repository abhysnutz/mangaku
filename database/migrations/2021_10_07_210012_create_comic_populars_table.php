<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comic_populars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comic_id');
            $table->integer('order');
            $table->boolean('day')->default(0);
            $table->boolean('week')->default(0);
            $table->boolean('month')->default(0);
            $table->boolean('all')->default(0);
            $table->timestamps();

            // Relation
            $table->foreign('comic_id')->references('id')->on('comics')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comic_populars');
    }
};