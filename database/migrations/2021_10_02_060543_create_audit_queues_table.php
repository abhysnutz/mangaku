<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('audit_queues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('queue_id');
            $table->string('url');
            $table->tinyInteger('status')->default(0);
            $table->text('msg');
            $table->timestamps();

            $table->foreign('queue_id')->references('id')->on('queues')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_queues');
    }
};