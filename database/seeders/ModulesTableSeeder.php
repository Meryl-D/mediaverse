<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/comem_modules.csv"), "r");
  
        $firstLine = true;

        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
                        
            if (!$firstLine) {

                DB::table('modules')->insert([
                    'name' => $data[0],
                    'credit' => $data[1],
                    'acronym' => $data[2],
                    'semester_id' => $data[3],
                    'sector_id' => $data[4]
                ]);  
            }

            $firstLine = false;
        }
   
        fclose($csvFile);
    }
}
