<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use App\Models\Classe;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = [];

        $dateNow = new DateTime();
        $courseIds = Auth::user()->courses()->pluck('course_id')->toArray();
        $lessons = Lesson::whereIn('course_id', $courseIds)
            ->where('date_start', '<=', $dateNow)
            ->where('date_end', '>=', $dateNow)->get()->toArray();

        $participants = [];
        foreach ($courseIds as $key => $courseId) {
            $participants[] = Course::find($courseId)->users()->get();
        }
        $students = User::where('id',$participants)->where('role_id',3)->get();
        // foreach ($lessons as $key => $lesson) {
        //     $classes[] = $lesson['class'];
        // }

        // $classIds = Classe::whereIn('name', $classes)->pluck('id');

        // $students = [];
        // foreach ($classIds as $key => $classId) {
        //     $students[] = Classe::find($classId)->users()->get();
        // }

        //$students = User::all()->classes()->whereIn('id', $classes);

        return $students;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
