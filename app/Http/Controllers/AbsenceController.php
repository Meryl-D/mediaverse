<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Absence;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AbsenceController extends Controller
{
    /**
     * Organize and prepare absence data for frontend.
     *
     * @param collection $absences
     *
     * @return collection
     */
    private function prepabsences($absences)
    {
        if (Gate::allows('isStudent')) {

            $absences = $absences->map(function ($absence, $key) {
                $lessonId = $absence->lesson_id;
                $lesson = Lesson::where('id', $lessonId)->first();
                $courseId = $lesson->pluck('course_id');
                $course = Course::where('id', $courseId)->first();
                $date = $lesson->date_start;

                return [
                    'state' => $absence->state,
                    'name' => $course->pluck('acronym'),
                    'dayShort' => ucfirst((new Carbon($date))->isoFormat('dd')),
                    'dayLong' => ucfirst((new Carbon($date))->isoFormat('dddd')),
                    'month' => ucfirst((new Carbon($date))->isoFormat('MMMM')),
                    'date' => $date->format('Y-m-d'),
                ];
            });

            return $absences;
        }
    }

    /**
     * If authentified as a teacher : return the list of students for the current lessons.
     * If authentified as a student : return the students absences.
     *
     * @return array
     */
    public function index()
    {
        if (Gate::allows('isTeacher')) {
            // $classes = [];
            // $dateNow = new DateTime();
            // $lessonIds = Auth::user()->lessons()->pluck('lesson_id')->toArray();
            // $absenceslessonIds = Absence::distinct()->whereIn('lesson_id', $lessonIds)
            //     ->where('date_start', '<=', $dateNow)
            //     ->where('date_end', '>=', $dateNow)->pluck('lesson_id')->toArray();

            // $absence[] = $absenceslessonIds;

            // $students = [];
            // foreach ($absenceslessonIds as $key => $absenceslessonId) {
            //     $students[] = Lesson::find($absenceslessonId)->users()->where('role_id', 3)->get();
            // }
            // $absence[] = $students;
            // return response()->json($absence);

        }

        if (Gate::allows('isStudent')) {

            $absences = Absence::where('user_id', Auth::id())
                ->get();
            $listeAbsence = $this->prepabsences($absences);
            return response()->json($listeAbsence);
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
