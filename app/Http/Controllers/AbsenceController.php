<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Absence;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
