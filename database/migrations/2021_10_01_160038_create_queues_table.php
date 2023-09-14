<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('grabber_id');
            $table->string('title');
            $table->integer('ref_id')->nullable();
            $table->tinyInteger('status')->comment('0 = PENDING, 1 = PROGRESS, 2 = FINISHED');;
            $table->timestamp('created_at')->nullable();
            $table->timestamp('progressed_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('grabber_id')->references('id')->on('grabbers')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queues');
    }
};