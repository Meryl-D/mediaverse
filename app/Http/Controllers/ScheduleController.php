<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{

    /**
     * Display a listing of the lessons.
     *
     * @return \Illuminate\Http\Response
     */ 
    /**
     * @return array
     */
    public function index()
    {
        $courseIds = Auth::user()->courses()->pluck('course_id')->toArray();

        $lessons = Lesson::whereIn('course_id', $courseIds)->orderBy('date_start', 'asc')->get()->toArray();

        return $lessons;
    }

}
