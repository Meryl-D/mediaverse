<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;


class NotificationController extends Controller
{

    /**
     * Retourne les notifications d'un utilisateurs
     * 
     * @return array
     */
    public function index()
    {
        if (!Gate::allows('isStudent')) {
            abort(403,"Vous n'avez pas les droits pour accéder à cette page");
        }

        $notifications = Auth::user()->receiverNotifications()->orderBy('created_at', 'desc')->get()->toArray();

        return $notifications;
    }

    /**
     * @param array $notifToAdd
     * 
     * @return void
     */
    public function add($notifToAdd)
    {
        $notification = new Notification([
            'title' => $notifToAdd['title'],
            'message'=> $notifToAdd['message'],
            'sender_id' => ''
        ]);

        $notification->receivers()->attach($notifToAdd['user_id']);

        $notification->save();
    }
}
