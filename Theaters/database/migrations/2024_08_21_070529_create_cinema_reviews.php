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
        if (!Schema::hasTable('cinema_reviews')) {
            
        Schema::create('cinema_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('theater_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->date('viewing_date');
            $table->integer('screen_number',);
            $table->string('seat_number',);
            $table->string('review',500);
        });
    }
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cinema_reviews');
    }
};
