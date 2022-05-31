<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['HEG', 'TIN', 'TIC', 'EC+G', 'COMEM+'];

        for ($i = 0; $i < count($names); $i++) { 
            
            DB::table('sectors')->insert([
                'name' => $names[$i]
            ]);
        }
    }
}
