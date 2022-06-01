<?php

namespace Database\Seeders;

use DateTimeZone;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;
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
        date_default_timezone_set('Europe/Zurich');

        $url = 'https://chabloz.eu/files/horaires/all.json';

        $lessons = json_decode(file_get_contents($url), true);

        foreach ($lessons as $key => $value) {

            $course_id = DB::table('courses')->where('acronym', $value['label'])->value('id');

            DB::table('lessons')->insert([
                'date_start' => Carbon::parse($value['start'])->setTimezone(new DateTimeZone('Europe/Zurich')),
                'date_end' => Carbon::parse($value['end'])->setTimezone(new DateTimeZone('Europe/Zurich')),
                'class' => substr($value['class'], 1),
                'room' => $value['room'],
                'course_id' => $course_id
            ]);
        }
    }
}
