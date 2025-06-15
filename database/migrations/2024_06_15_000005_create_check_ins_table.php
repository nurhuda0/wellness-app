<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('check_ins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('partner_id')->constrained()->onDelete('cascade');
            $table->timestamp('check_in_time');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('check_ins');
    }
};
