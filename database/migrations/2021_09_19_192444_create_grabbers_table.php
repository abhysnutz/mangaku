<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('grabbers', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->string('artisan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('grabbers');
    }
};