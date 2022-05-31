<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'M48'
            ],
            [
                'name' => 'M49-1'
            ],
            [
                'name' => 'M49-2'
            ],
            [
                'name' => 'M50-1'
            ],
            [
                'name' => 'M50-2'
            ],
            [
                'name' => 'M50-3'
            ]
        ];

        DB::table('classes')->insert($data);
    }
}
