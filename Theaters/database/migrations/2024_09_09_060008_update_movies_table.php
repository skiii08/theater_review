<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function (Blueprint $table) {
            // idカラムの修正：auto-incrementを削除し、unsignedBigIntegerに変更
            $table->unsignedBigInteger('id')->change();

            // 既存のカラムの修正：すべてNULLを許容
            $table->string('title', 100)->nullable()->change();
            $table->date('date')->nullable()->change();
            $table->integer('time')->nullable()->change();
            $table->string('genre', 50)->nullable()->change();
            $table->string('director', 50)->nullable()->change();
            $table->string('cast', 255)->nullable()->change(); // キャストの長さを増やす
            $table->text('story')->nullable()->change(); // storyをvarcharからtextに変更
            $table->string('poster_uri', 500)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies', function (Blueprint $table) {
            // 変更を元に戻す場合の処理
            // この例では特に何もしない
        });
    }
}