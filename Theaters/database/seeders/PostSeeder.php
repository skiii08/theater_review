<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use DateTime;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                       DB::table('cinema_reviews')->insert([
            [
                'id' => 1,
                'theater_id' => 1,
                'user_id' => 1,
                'viewing_date' => '2022-12-01', // 日付は通常 'YYYY-MM-DD' 形式で保存します
                'screen_number' => 1,
                'seat_number' => 'A4',
                'review' => '席が近かったです',
            ],
            [
                'id' => 2,
                'theater_id' => 2,
                'user_id' => 2,
                'viewing_date' => '2022-10-24',
                'screen_number' => 1,
                'seat_number' => 'F5',
                'review' => '音響が良かった',
            ],
        ]);
         
}

}
