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
    private function getDatesInRange($dateStart, $dateEnd) {

        $period = CarbonPeriod::create($dateStart, $dateEnd);

        return $period;
    }

    /**
     * Return authentified users schedule and all holidays.
     * 
     * @return array
     */
    public function index()
    {
        $courses = Auth::user()->courses()->get();
        $courseIds = $courses->pluck('id')->toArray();

        $lessons = Lesson::whereIn('course_id', $courseIds)->orderBy('date_start', 'asc')->get();

        $currDate = new Carbon();
        $currSemesterDates = Semester::select('date_start', 'date_end')
            ->where('date_start', '<=', $currDate)
            ->where('date_end', '>=', $currDate)
            ->first()->toArray();

        $holidays = Holiday::all();

        $dates = $this->getDatesInRange($currSemesterDates['date_start'], $currSemesterDates['date_end']);

        $data = [
            'courses' => $courses,
            'lessons' => $lessons,
            'holidays' => $holidays
        ];

        return response()->json($dates);
    }

}
