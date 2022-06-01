<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $listCourses= Auth::user()->courses()->pluck('course_id')->toArray();
        //dd($listCourses);
        $reviews = Review::where('course_id', $listCourses)->with('course')->orderBy('created_at', 'desc')->get()->toArray();
        //dd($reviews);
        return $reviews;
    }

    public function add(ReviewRequest $request)
    {
        $review = new Review([
            'rating' => $request->input('rating'),
            'feedback'=>$request->input('feedback')
        ]);
        $review->save();

        return response()->json('Review ajoutée avec succès');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

}
