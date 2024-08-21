<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('screen_numbers', function (Blueprint $table) {
            $table->id();
            $table->integer('screen_number',);
            $table->integer('seeting_capacity',);

            $table->string('screen_size', 50);
            $table->string('sound_system', 50);
            $table->string('projection_type', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screen_numbers');
    }
};
