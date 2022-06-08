<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Holiday;
use App\Models\Semester;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Returns an array with all the dates of the current semesters.
     * 
     * @return array
     */
    private function getDatesInSemester() {

        $currDate = new Carbon();

        $currSemesterDates = Semester::select('date_start', 'date_end')
            ->where('date_start', '<=', $currDate)
            ->where('date_end', '>=', $currDate)
            ->first()->toArray();
        
        $dateStart = new Carbon($currSemesterDates['date_start']);
        $dateEnd = new Carbon($currSemesterDates['date_end']);

        $allDates = CarbonPeriod::create($dateStart, $dateEnd);

        $allDates = collect($allDates->map(function($date) {
            return $date->format('Y-m-d');
        }));

        return $allDates;

    }

    /**
     * Returns an array with only the week days.
     * 
     * @param array (of strings) $dates
     * 
     * @return array
     */
    private function getWeekDays($dates) {

        $weekDays = [];

        foreach ($dates as $key => $date) {
        
            $date = new Carbon($date); //needs to be a date for isWeekDay()
            if ($date->isWeekDay()) $weekDays[] = $date->format('Y-m-d');
        }

        return $weekDays;
    }

    /**
     * Organize and prepare lessons data for frontend.
     * 
     * @param collection $lessons
     * 
     * @return collection 
     */
    private function prepLessons($lessons) {

        $lessons = $lessons->map(function ($lesson, $key) {
            $course = Course::where('id', $lesson->course_id)->first();

            return [
                'dayShort' => ucfirst($lesson->date_start->isoFormat('dd')),
                'dayLong' => ucfirst($lesson->date_start->isoFormat('dddd')),
                'month' => ucfirst($lesson->date_start->isoFormat('MMMM')),
                'date' => $lesson->date_start->format('Y-m-d'),
                'name' => $course->name,
                'timeStart'  => $lesson->date_start->format('H:i'),
                'timeEnd' => $lesson->date_end->format('H:i'),
                'room' => $lesson->room
            ];
        });

        return $lessons;
    }

    private function prepHolidays($holidays) {

        $holidays = $holidays->map(function ($holidays, $key) {

            return [
                'name' => $holidays->name,
                'dateStart' => (new Carbon($holidays->date_start))->format('Y-m-d'),
                'dateEnd' => (new Carbon($holidays->date_end))->format('Y-m-d')
            ];
        });

        return $holidays;
    }

    // private function prepAgendaSchedule($lessons, $holidays) {

    //     $dates = $this->getDatesInSemester();

    //     foreach ($dates as $key => $date) {
            
    //         $lessonsOfDate = $lessons->where('date', $date)->get();
            
    //         return $lessonsOfDate;
    //     }

    //     return $lessonsOfDate;   
    // }

    // private function prepWeeklySchedule($agendaSchedule) {

    // }

    /**
     * Returns authenticated users schedule and all holidays.
     *
     * @return array
     */
    public function index()
    {
        $courses = Auth::user()->courses()->get();
        $courseIds = $courses->pluck('id')->toArray();

        $lessons = Lesson::whereIn('course_id', $courseIds)->orderBy('date_start', 'asc')->get();

        $holidays = Holiday::all();

        $datesInSemester = $this->getDatesInSemester(); // needed for the agenda view
        $weekDays = $this->getWeekDays($datesInSemester); // needed for the weekly view
        $lessons = $this->prepLessons($lessons);
        $holidays = $this->prepHolidays($holidays);

        //$agendaSchedule = $this->prepAgendaSchedule($lessons, $holidays);

        $data = [
            'lessons' => $lessons,
            'holidays' => $holidays,
            'weekDays' => $weekDays,
            'allDays' => $datesInSemester
        ];

       // return response()->json($agendaSchedule);
    }

}
