<?php

namespace Database\Seeders;

use DateTime;
use DateInterval;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $url = 'https://chabloz.eu/files/horaires/all.json';

        $lessons = json_decode(file_get_contents($url), true);

        foreach ($lessons as $key => $value) {

            // $output->writeln(var_dump($value));

            $course_id = DB::table('courses')->where('acronym', $value['label'])->value('id');
            
            DB::table('lessons')->insert([
                'date_start' => (DateTime::createFromFormat(DateTime::ATOM, $value['start']))->add(new DateInterval('PT02H')),
                'date_end' => (DateTime::createFromFormat(DateTime::ATOM, $value['end']))->add(new DateInterval('PT02H')),
                'class' => substr($value['class'], 1),
                'room' => $value['room'],
                'course_id' => $course_id
            ]);
        }
    }
}
