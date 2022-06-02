<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**show user
     * @return [array]
     */
    public function index()
    {
        $user = Auth::user();

        return $user;
    }
}
