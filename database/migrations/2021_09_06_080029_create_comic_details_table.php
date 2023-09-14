<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comic_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('comic_id');
            $table->text('alias')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('Ongoing');
            $table->string('type')->default('Manga');
            $table->string('released')->nullable();
            $table->text('author')->nullable();
            $table->text('artist')->nullable();
            $table->string('serialization')->nullable();
            $table->string('posted_by')->nullable();
            $table->string('posted_on')->nullable();
            $table->float('rating')->nullable()->default(0);
            $table->integer('follower')->nullable()->default(0);
            $table->unsignedInteger('view')->nullable()->default(0);
            $table->unsignedTinyInteger('image')->default(0);
            $table->unsignedTinyInteger('bg_image')->default(0);
            $table->boolean('color')->default(0);
            $table->boolean('project')->default(0);

            // RELASI TABEL
            $table->foreign('comic_id')->references('id')->on('comics')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comic_detail');
    }
};