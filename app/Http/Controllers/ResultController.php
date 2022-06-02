<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Models\Result;
use App\Models\Sector;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class ResultController extends Controller
{
    /**
     * If authentified as a teacher : returns a list of his courses, students, classes and sectors. 
     * If authentified as a student : returns the students results and the related courses, modules and semesters.
     * 
     * @return array
     */
    public function index()
    {
        //check the role of the user
        if (Gate::allows('isTeacher')) {
            //get all the courses
            $listeCourses = Auth::user()->courses()->pluck('course_id')->toArray();

            $listeClasses = Lesson::select("class")->distinct()->whereIn('course_id', $listeCourses)->get()->toArray();

            $listeStudent = User::whereHas('courses', function ($query) use ($listeCourses) {
                $query->whereIn('course_id', $listeCourses);
            })->whereHas('classes', function ($query) use ($listeClasses) {
                $query->whereIn('name', $listeClasses);
            })->get();

            $listeSector = Auth::user()->sector()->pluck('name')->toArray();

            $dataResultTeacher = [
                "listeCourse" => $listeCourses,
                "listeClasses" => $listeClasses,
                "listeStudent" => $listeStudent,
                "listeSector" => $listeSector,
            ];

            return $dataResultTeacher;
            
        } else {
            $results = Result::where('receiver_id', Auth::id())->get();
            $resultCourseId = $results->pluck('course_id');

            $listeCourses = Course::distinct()->whereIn('id', $resultCourseId)->get();            
            $listeCoursesIds = $listeCourses->pluck('module_id');
            $modules = Module::distinct()->whereIn('id', $listeCoursesIds)->get();
            
            $moduleSemesterIds = $modules->pluck('semester_id');
            $semesters = Semester::distinct()->whereIn('id', $moduleSemesterIds)->get();
                    
            
            $dataResultStudent = [
                "results" => $results,
                "listeCourses" => $listeCourses,
                "modules" => $modules,
                "semesters" => $semesters
            ];
            return $dataResultStudent;
        }
    }

    /**
     * Add a result to the database.
     *
     * @return json
     */

    public function add(Request $request)
    {

        foreach ($request->get('users') as $userData) {
            $result = new Result;
            $result->grade = $userData['grade'];
            $result->weight = $userData['weight'];
            $result->type = $userData['type'];
            $result->date_examen = $userData['date_examen'];
            $result->giver_id = Auth::id();
            $result->receiver_id = $userData['receiver_id'];
            $result->course_id = $userData['course_id'];

            $result->save();
        }
        return response()->json('Les notes ont bien été saisies');
    }
}
