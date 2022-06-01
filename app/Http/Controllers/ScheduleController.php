<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{

    /**
<<<<<<< HEAD
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
=======
     * Retourne tous les cours d'un utilisateur
     * 
     * @return array
     */
>>>>>>> 497c45c9485d7ec65a4b14331e1291d4378a3ea3
    public function index()
    {
        $courseIds = Auth::user()->courses()->pluck('course_id')->toArray();

        $lessons = Lesson::whereIn('course_id', $courseIds)->orderBy('date_start', 'asc')->get()->toArray();

        return $lessons;
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     //
    // }
}
