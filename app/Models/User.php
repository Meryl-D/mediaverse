<?php

namespace App\Models;

use App\Models\Role;
use App\Models\Task;
use App\Models\Classe;
use App\Models\Course;
use App\Models\Result;
use App\Models\Review;
use App\Models\Sector;
use App\Models\Absence;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'picture', 'sector_id', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Permet d'encoder le mot de passe
     * @param type $password Le mot de passe
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }
    
    public function role() {
        return $this->belongsTo(Role::class);      
    }

    public function sector() {
        return $this->belongsTo(Sector::class);      
    }

    public function tasks() {
        return $this->hasMany(Task::class);      
    }

    public function giverResults() {
        return $this->hasMany(Result::class, 'giver_id');      
    }

    public function receiverResults() {
        return $this->hasMany(Result::class, 'receiver_id');      
    }

    public function reviews() {
        return $this->hasMany(Review::class);      
    }

    public function senderNotifications() {
        return $this->hasMany(Notification::class);      
    }

    public function receiverNotifications() {
        return $this->belongsToMany(Notification::class, 'notification_user', 'receiver_id');      
    }

    public function absences() {
        return $this->hasMany(Absence::class);      
    }

    public function courses() {
        return $this->belongsToMany(Course::class);      
    }

    public function classes() {
        return $this->belongsToMany(Classe::class);      
    }
}
