<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {   
        //check the role of the user
        if(Gate::allows('isTeacher')){ 
            //get all the courses
            $listeCourses = Auth::user()->courses()->pluck('course_id')->toArray();
            dd($listeCourses);
        }
        
        $results = Result::where('receiver_id', Auth::id())->get()->toArray(); 
        dd($results);
        return $results; 
        
        if(Gate::allows('isStudent')){

        }
    
    }



    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
    */

    public function add(Request $request)
    {

        //validation
        $this->validate($request,[
            'users.*.user_grade' => 'required|float|min:1|max:6',
            'users.*.weight' => 'required|float',
            'users.*.type' => 'required|string',
            'users.*.date_examen' => '^(0[1-9]|[12][0-9]|3[01])[- /.](0[1-9]|1[012])[- /.](19|20)\d\d$',
        ]);

        foreach($request->get('users') as $userData){
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