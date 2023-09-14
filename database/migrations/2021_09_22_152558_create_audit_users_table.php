<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('audit_users', function (Blueprint $table) {
            $table->id();
            $table->text('url');
            $table->string('tags');
            $table->text('msg');
            $table->string('ip_address');
            $table->text('user_agent');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_users');
    }
};