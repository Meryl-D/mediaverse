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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Return a Collection with all the dates of the current semesters.
     * 
     * @return Collection
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
     * Organize and prepare lessons data.
     * Format lessons dates and replace course id by its name.
     * 
     * @param Collection $lessons
     * 
     * @return Collection 
     */
    private function prepLessons($lessons) {

        $lessons = $lessons->map(function ($lesson, $key) {
            $course = Course::where('id', $lesson->course_id)->first();

            return [
                'date' => $lesson->date_start->format('Y-m-d'),
                'name' => $course->name,
                'timeStart'  => $lesson->date_start->format('H:i'),
                'timeEnd' => $lesson->date_end->format('H:i'),
                'room' => $lesson->room
            ];
        });

        return $lessons;
    }

    /**
     * format holidays dates.
     *
     * @param Collection $holidays
     * 
     * @return Collection
     */
    private function prepHolidays($holidays) {

        $holidays = $holidays->map(function ($holiday, $key) {

            return [
                'name' => $holiday->name,
                'dateStart' => (new Carbon($holiday->date_start))->format('Y-m-d'),
                'dateEnd' => (new Carbon($holiday->date_end))->format('Y-m-d')
            ];
        });

        return $holidays;
    }

    /**
     * Create an array with all data needed for every day of a semester.
     * 
     * @param Collection $lessons
     * @param Collection $holidays
     * 
     * @return array
     */
    private function prepAgendaSchedule($lessons, $holidays) {

        $dates = $this->getDatesInSemester();
        $data = collect();

        foreach ($dates as $date) {
            
            $lessonsOfDate = $lessons->where('date', $date);
            $holidayOfDate = $holidays->where('dateStart', '<=', $date)->where('dateEnd', '>=', $date)->first();

            if (!$lessonsOfDate->isEmpty()) {
                foreach ($lessonsOfDate as $lesson) {
                    $data->push([
                        'name' => $lesson['name'],
                        'timeStart'  => $lesson['timeStart'],
                        'timeEnd' => $lesson['timeEnd'],
                        'room' => $lesson['room'],
                        'dayShort' => ucfirst((new Carbon($date))->isoFormat('dd')),
                        'dayLong' => ucfirst((new Carbon($date))->isoFormat('dddd')),
                        'month' => ucfirst((new Carbon($date))->isoFormat('MMMM')),
                        'date' => $date
                    ]);
                };
            };

            if ($holidayOfDate) {
                $data->push([
                    'name' => $holidayOfDate['name'],
                    'dayShort' => ucfirst((new Carbon($date))->isoFormat('dd')),
                    'dayLong' => ucfirst((new Carbon($date))->isoFormat('dddd')),
                    'month' => ucfirst((new Carbon($date))->isoFormat('MMMM')),
                    'date' => $date
                ]);
            };

            if ($lessonsOfDate->isEmpty() && !$holidayOfDate) {
                $data->push([
                    'dayShort' => ucfirst((new Carbon($date))->isoFormat('dd')),
                    'dayLong' => ucfirst((new Carbon($date))->isoFormat('dddd')),
                    'month' => ucfirst((new Carbon($date))->isoFormat('MMMM')),
                    'date' => $date
                ]);
            }
        };

        $data = $data->all();

        return $data;   
    }

    /**
     * Create an array with all data needed for every weekday of a semester.
     * 
     * @param array $schedule
     * 
     * @return array
     */
    private function prepWeeklySchedule($schedule) {
        foreach ($schedule as $key => $date) {
            if ($date['dayShort'] == 'Sa' || $date['dayShort'] == 'Di') unset($schedule[$key]);
        }
        
        $schedule = array_values($schedule);

        return $schedule;
    }

    /**
     * Return an array with weekday and every day schedules for the authenticated user.
     *
     * @return array
     */
    public function index()
    {
        $courses = Auth::user()->courses()->get();
        $courseIds = $courses->pluck('id')->toArray();
        $classes = Auth::user()->classes()->pluck('name');

        $lessons = Lesson::whereIn('course_id', $courseIds)
            ->whereIn('class', $classes)
            ->orderBy('date_start', 'asc')
            ->get();

        $holidays = Holiday::all();

        $lessons = $this->prepLessons($lessons);
        $holidays = $this->prepHolidays($holidays);

        $allDaysSchedule = $this->prepAgendaSchedule($lessons, $holidays); // needed for the agenda view
        $weekDaysSchedule = $this->prepWeeklySchedule($allDaysSchedule); // needed for the weekly view

        $data = [
            'allDaysSchedule' => $allDaysSchedule,
            'weekDaysSchedule' => $weekDaysSchedule,
        ];

        return $data;
    }

}
