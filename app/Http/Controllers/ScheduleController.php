<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lesson;
use App\Models\Holiday;
use App\Models\Semester;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Get all week days between two dates.
     * 
     * @param Carbon $dateStart
     * @param Carbon $dateEnd
     * 
     * @return array
     */
    private function getDatesInRange($dateStart, $dateEnd) {

        $allDates = CarbonPeriod::create($dateStart, $dateEnd);

        $weekDays = [];

        foreach ($allDates as $key => $date) {
            if ($date->isWeekDay()) $weekDays[] = $date;
        }

        return $weekDays;
    }

    // private function arrangeLessons($lessons, $courses) {

    //     foreach ($lessons as $key => $lesson) {
    //         $courseId = array_search($lesson->course_id, $courses);
    //         $courseName = $courses[$courseId]->name;

    //         $lesson->course_id = $courseName;
    //     }
    // }

    /**
     * Return authentified users schedule and all holidays.
     *
     * @return array
     */
    public function index()
    {
        $courses = Auth::user()->courses()->get();
        $courseIds = $courses->pluck('id')->toArray();

        $lessons = Lesson::whereIn('course_id', $courseIds)->orderBy('date_start', 'asc')->get()->toArray();

        $currDate = new Carbon();

        $currSemesterDates = Semester::select('date_start', 'date_end')
            ->where('date_start', '<=', $currDate)
            ->where('date_end', '>=', $currDate)
            ->first()->toArray();

        $holidays = Holiday::all();

        $currDateStart = new Carbon($currSemesterDates['date_start']);
        $currDateEnd = new Carbon($currSemesterDates['date_end']);

        $weekDays = $this->getDatesInRange($currDateStart, $currDateEnd);

        $data = [
            'courses' => $courses,
            'lessons' => $lessons,
            'holidays' => $holidays,
            'weekDays' => $weekDays
        ];

        //$lessons = $this->arrangeLessons($lessons, $courses);

        return response()->json($data);
    }

}
