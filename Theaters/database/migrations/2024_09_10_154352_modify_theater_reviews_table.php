<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTheaterReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('theater_reviews', function (Blueprint $table) {
            $table->integer('screen_number')->nullable()->default(null)->change();
            $table->string('seat_number')->nullable()->default(null)->change();
            $table->string('image_url')->nullable()->default('https://thumb.ac-illust.com/39/3920178d66157451930de97cc5431a64_t.jpeg')->change();
            $table->string('review', 500)->nullable()->default(null)->change();
        });
    }

    public function down()
    {
        Schema::table('theater_reviews', function (Blueprint $table) {
            $table->integer('screen_number')->nullable(false)->change();
            $table->string('seat_number')->nullable(false)->change();
            $table->string('image_url')->nullable()->default(null)->change();
            $table->string('review', 500)->nullable(false)->change();
        });
    }
}