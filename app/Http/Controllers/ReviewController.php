<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //check the role of the user
        if (Gate::allows('isTeacher')) {
            $listCourses = Auth::user()->courses()->pluck('course_id')->toArray();
            //dd($listCourses);
            $reviews = Review::where('course_id', $listCourses)->with('course')->orderBy('created_at', 'desc')->get()->toArray();
            //dd($reviews);
            return $reviews;
        }
    }

    public function create()
    {

        //check the role of the user
        if (Gate::allows('isStudent')) {

            $listCourses = Auth::user()->courses()->pluck('course_id')->toArray();
            return $listCourses;


        }
    }

    public function add(ReviewRequest $request)
    {
            $review = new Review([
                'rating' => $request->input('rating'),
                'feedback' => $request->input('feedback'),
                'user_id' => Auth::id(),
                'course_id' => $request->input('course_id')
            ]);
            $review->save();

            return response()->json('Review ajoutée avec succès');
        
    }


}
