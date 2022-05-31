<?php

namespace App\Models;

use App\Models\User;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Result extends Model
{
    use HasFactory;

    public $timestamps = false; 

    protected $fillable = [
        'grade', 'weight', 'type', 'date_exam', 'giver_id', 'receiver_id', 'course_id',
    ];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function giver() {
        return $this->belongsTo(User::class, 'giver_id');
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }

}
