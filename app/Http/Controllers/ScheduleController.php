<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lesson;
use App\Models\Holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    /**
     * Return authentified users schedule and all holidays.
     * 
     * @return array
     */
    public function index()
    {
        $courseIds = Auth::user()->courses()->pluck('course_id')->toArray();

        $lessons = Lesson::whereIn('course_id', $courseIds)->orderBy('date_start', 'asc')->get()->toArray();

        $holidays = Holiday::all();

        return [
            'lessons' => $lessons,
            'holidays' => $holidays
        ];
    }

}
