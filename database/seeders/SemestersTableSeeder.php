<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Carbon;

class SemestersTableSeeder extends Seeder
{

    private function strToDate($dateStr) {
        return new Carbon($dateStr);
    }

    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dateStart = ['2021-09-20', '2022-02-21'];
        $dateEnd = ['2022-02-20', '2022-09-18'];

        for ($i = 1; $i <= 6; $i++) { 

            if($i % 2 != 0) {

                DB::table('semesters')->insert([
                    'date_start' => $dateStart[0],
                    'date_end' => $dateEnd[0],
                    'number' => $i
                ]);
            } else {

                DB::table('semesters')->insert([
                    'date_start' => $dateStart[1],
                    'date_end' => $dateEnd[1],
                    'number' => $i
                ]);
            }
        }
    }
}
