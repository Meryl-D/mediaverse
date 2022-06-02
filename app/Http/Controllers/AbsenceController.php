<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Absence;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AbsenceController extends Controller
{
    /**
     * If authentified as a teacher : return the list of students for the current courses.
     * If authentified as a student : return the students absences.
     * 
     * @return array
     */
    public function index()
    {
        if (Gate::allows('isTeacher')) {
            $classes = [];
            $dateNow = new DateTime();
            $courseIds = Auth::user()->courses()->pluck('course_id')->toArray();
            $lessonsCourseIds = Lesson::distinct()->whereIn('course_id', $courseIds)
                ->where('date_start', '<=', $dateNow)
                ->where('date_end', '>=', $dateNow)->pluck('course_id')->toArray();

            $students = [];
            foreach ($lessonsCourseIds as $key => $lessonsCourseId) {
                $students[] = Course::find($lessonsCourseId)->users()->where('role_id', 3)->get();
            }
            return $students;
        }

        if (Gate::allows('isStudent')) {
            $absence = Absence::where('user_id', Auth::id())
                ->get()
                ->toArray();
            return $absence;
        }

    }

    /**
     * 
     * 
     * @return json
     */
    public function add()
    {
        if (Gate::allows('isTeacher')) {
            $absence = new Absence([
                'state' => $request->input('state'),
            ]);
            $absence->save();
            return response()->json('Absences enregistée');
        }
    }
}
