<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/comem_courses.csv"), "r");
  
        $firstLine = true;

        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
                        
            if (!$firstLine) {

                DB::table('courses')->insert([
                    'acronym' => $data[0],
                    'name' => $data[2],
                    'total_periods' => $data[3],
                    'weight' => $data[4],
                    'module_id' => $data[5]
                ]);  
            }

            $firstLine = false;
        }
   
        fclose($csvFile);
    }
}
