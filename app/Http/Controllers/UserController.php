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
>>>>>>> 8938879c8814eb8ce62051008adfa8986b606a61
    public function index()
    {
        $user = Auth::user();

        return $user;
    }
}
