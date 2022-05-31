<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $output = new ConsoleOutput();

        $courseIds = DB::table('lessons')
            ->distinct()
            ->where('class', 'M49-2')
            ->pluck('course_id');

        $notCourses = [36, 45, 50];

        $courseIds = $courseIds->toArray();

        foreach ($notCourses as $key => $value) {

            $notCourseKey = array_search($value, $courseIds);
            unset($courseIds[$notCourseKey]);

        }
    
        // $output->writeln($courseIds);

        foreach ($courseIds as $key => $value) {

            DB::table('course_user')->insert([
                'course_id' => $value,
                'user_id' => 1,
            ]);  
        }

        $data = [
            [
                'course_id' => 39,
                'user_id' => 2
            ],
            [
                'course_id' => 62,
                'user_id' => 2
            ]
        ];

        DB::table('course_user')->insert($data);
    }
}
