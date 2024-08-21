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
        /*
         DB::table('screen_numbers')->insert([
                'screen_number' => 1,
                'seeting_capacity' => 217,
                'screen_size' => '4.4 × 10.6',
                'sound_system' =>'デジタル7.1ch',
                'projection_type' => ''
         ]);
         */
          DB::table('theaters')->insert([
                'theater_name' => 'OSシネマズミント神戸',
                'adress' => '兵庫県神戸市中央区雲井通7-1-1ミント神戸9F',
                'screen_number_id' => 1,
         ]);      
    }
}
