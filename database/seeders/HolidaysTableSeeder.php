<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DB::statement("ALTER TABLE holidays AUTO_INCREMENT = 1;");

        $data = [
            [
                'date_start' => '2021-09-20',
                'date_end' => '2021-09-20',
                'name' => 'Lundi du Jeûne fédéral'
            ],
            [
                'date_start' => '2021-10-25',
                'date_end' => '2021-10-31',
                'name' => 'Vacances d\'automne'
            ],
            [
                'date_start' => '2021-12-24',
                'date_end' => '2021-10-31',
                'name' => 'Vacances de Noël'
            ],
            [
                'date_start' => '2022-01-31',
                'date_end' => '2022-02-20',
                'name' => 'Vacances d\'hiver'
            ],
            [
                'date_start' => '2022-04-15',
                'date_end' => '2022-04-24',
                'name' => 'Vacances de Pâques'
            ],
            [
                'date_start' => '2022-05-26',
                'date_end' => '2022-05-27',
                'name' => 'Ascension'
            ],
            [
                'date_start' => '2022-06-06',
                'date_end' => '2022-06-06',
                'name' => 'Pentecôte'
            ],
            [
                'date_start' => '2022-07-04',
                'date_end' => '2022-09-18',
                'name' => 'Vacances d\'été'
            ],
            [
                'date_start' => '2022-09-19',
                'date_end' => '2022-09-19',
                'name' => 'Lundi du Jeûne fédéral'
            ]
        ];

        DB::table('holidays')->insert($data);
    }
}
