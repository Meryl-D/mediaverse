<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
<<<<<<< HEAD
    
=======

    /**show user
     * @return [array]
     */
>>>>>>> 03e52cc3cf34d3dc89307d4828cbf1ddcdc96cda
    public function index()
    {
        $user = Auth::user();

        return $user;
    }
}
